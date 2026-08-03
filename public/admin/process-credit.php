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
| Form Data
|--------------------------------------------------------------------------
*/

$userId = intval($_POST['user_id']);
$amount = floatval($_POST['amount']);
$narration = trim($_POST['narration']);

if ($amount <= 0) {
    die("Invalid amount.");
}

try {

    $pdo->beginTransaction();

    /*
    |--------------------------------------------------------------------------
    | Load Wallet
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

    $before = $wallet['balance'];
    $after = $before + $amount;

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
        "balance" => $after,
        "user_id" => $userId
    ]);

    /*
    |--------------------------------------------------------------------------
    | Transaction
    |--------------------------------------------------------------------------
    */

    $reference = "ADM" . time() . rand(100,999);

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
        :type,
        :description,
        :amount,
        :before,
        :after,
        :status,
        :reference
    )
    ");

    $stmt->execute([

        "user_id" => $userId,

        "type" => "admin_credit",

        "description" => $narration,

        "amount" => $amount,

        "before" => $before,

        "after" => $after,

        "status" => "Successful",

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
        :title,
        :message,
        :type
    )
    ");

    $stmt->execute([

        "user_id" => $userId,

        "title" => "Wallet Credited",

        "message" => "Your wallet has been credited with ₦" . number_format($amount,2),

        "type" => "wallet"

    ]);

    $pdo->commit();

    header("Location: view-user.php?id=" . $userId);

    exit;

} catch (Exception $e) {

    $pdo->rollBack();

    die($e->getMessage());

}
