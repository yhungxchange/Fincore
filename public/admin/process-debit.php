<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$config = require __DIR__ . '/../../config/database.php';
require __DIR__ . '/../../app/Database.php';

$db = new Database($config);
$pdo = $db->connection();

/*
|--------------------------------------------------------------------------
| Verify Admin
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
SELECT is_admin
FROM users
WHERE id = :id
LIMIT 1
");

$stmt->execute([
    "id" => $_SESSION['user_id']
]);

$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$admin || !$admin['is_admin']) {
    die("Access Denied");
}

/*
|--------------------------------------------------------------------------
| Inputs
|--------------------------------------------------------------------------
*/

$userId = (int) $_POST['user_id'];
$amount = (float) $_POST['amount'];
$narration = trim($_POST['narration']);

if ($amount <= 0) {
    die("Invalid amount.");
}

try {

    $pdo->beginTransaction();

    /*
    |--------------------------------------------------------------------------
    | Lock Wallet
    |--------------------------------------------------------------------------
    */

    $stmt = $pdo->prepare("
    SELECT balance
    FROM wallets
    WHERE user_id = :user_id
    FOR UPDATE
    ");

    $stmt->execute([
        "user_id" => $userId
    ]);

    $wallet = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$wallet) {
        throw new Exception("Wallet not found.");
    }

    $balanceBefore = $wallet['balance'];

    if ($balanceBefore < $amount) {
        throw new Exception("Insufficient wallet balance.");
    }

    $balanceAfter = $balanceBefore - $amount;

    /*
    |--------------------------------------------------------------------------
    | Update Wallet
    |--------------------------------------------------------------------------
    */

    $stmt = $pdo->prepare("
    UPDATE wallets
    SET balance = :balance
    WHERE user_id = :user_id
    ");

    $stmt->execute([
        "balance" => $balanceAfter,
        "user_id" => $userId
    ]);

    /*
    |--------------------------------------------------------------------------
    | Transaction
    |--------------------------------------------------------------------------
    */

    $reference = "ADMDR" . time() . rand(100,999);

    $stmt = $pdo->prepare("
    INSERT INTO transactions
    (
        user_id,
        type,
        description,
        amount,
        balance_before,
        balance_after,
        status,
        reference
    )
    VALUES
    (
        :user_id,
        'admin_debit',
        :description,
        :amount,
        :before,
        :after,
        'Successful',
        :reference
    )
    ");

    $stmt->execute([
        "user_id" => $userId,
        "description" => $narration,
        "amount" => $amount,
        "before" => $balanceBefore,
        "after" => $balanceAfter,
        "reference" => $reference
    ]);

    /*
    |--------------------------------------------------------------------------
    | Notification
    |--------------------------------------------------------------------------
    */

    $stmt = $pdo->prepare("
    INSERT INTO notifications
    (
        user_id,
        title,
        message,
        type
    )
    VALUES
    (
        :user_id,
        'Wallet Debited',
        :message,
        'wallet'
    )
    ");

    $stmt->execute([
        "user_id" => $userId,
        "message" => "₦" . number_format($amount,2) . " was deducted from your wallet.\nReason: " . $narration
    ]);

    $pdo->commit();

    header("Location: view-user.php?id=".$userId."&success=Wallet debited successfully");

    exit;

} catch(Exception $e){

    $pdo->rollBack();

    die($e->getMessage());

}
