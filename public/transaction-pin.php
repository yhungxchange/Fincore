<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$config = require __DIR__ . '/../config/database.php';
require __DIR__ . '/../app/Database.php';

$db = new Database($config);
$pdo = $db->connection();

$userId = $_SESSION['user_id'];

if (!isset($_SESSION['fund_amount'])) {
    header("Location: manual-funding.php");
    exit;
}

$amount = (float) $_SESSION['fund_amount'];

// Get user information
$stmt = $pdo->prepare("
    SELECT
        full_name,
        transaction_pin
    FROM users
    WHERE id = :id
    LIMIT 1
");

$stmt->execute([
    'id' => $userId
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pin = trim($_POST['pin']);

    // Verify PIN
    if (!password_verify($pin, $user['transaction_pin'])) {

        $_SESSION['error'] = "Incorrect Transaction PIN.";

        header("Location: transaction-pin.php");
        exit;
    }

    try {

        $pdo->beginTransaction();

        // Lock wallet row
        $walletStmt = $pdo->prepare("
            SELECT balance
            FROM wallets
            WHERE user_id = :user_id
            FOR UPDATE
        ");

        $walletStmt->execute([
            'user_id' => $userId
        ]);

        $wallet = $walletStmt->fetch(PDO::FETCH_ASSOC);

        if (!$wallet) {
            throw new Exception("Wallet not found.");
        }

        $balanceBefore = (float)$wallet['balance'];
        $balanceAfter = $balanceBefore + $amount;

        // Update wallet balance
        $updateWallet = $pdo->prepare("
            UPDATE wallets
            SET balance = :balance
            WHERE user_id = :user_id
        ");

        $updateWallet->execute([
            'balance' => $balanceAfter,
            'user_id' => $userId
        ]);

        // Generate unique reference
        $reference = "FC" . date("YmdHis") . rand(1000,9999);

        // Save transaction
        $saveTransaction = $pdo->prepare("
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
                :balance_before,
                :balance_after,
                :status,
                :reference
            )
        ");

        $saveTransaction->execute([
            'user_id' => $userId,
            'type' => 'funding',
            'description' => 'Manual Wallet Funding',
            'amount' => $amount,
            'balance_before' => $balanceBefore,
            'balance_after' => $balanceAfter,
            'status' => 'successful',
            'reference' => $reference
        ]);

        $pdo->commit();

        // Save success details for success page
        $_SESSION['success'] = "Wallet funded successfully!";
        $_SESSION['funding_amount'] = $amount;
        $_SESSION['funding_reference'] = $reference;

        // Clear funding session
        unset($_SESSION['fund_amount']);

        header("Location: funding-success.php");
        exit;

    } catch (Exception $e) {

        $pdo->rollBack();

        $_SESSION['error'] = "Funding failed. Please try again.";

        header("Location: transaction-pin.php");
        exit;
    }
}

require __DIR__ . '/../views/transaction-pin.php';
