<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| Database
|--------------------------------------------------------------------------
*/

$config = require __DIR__ . '/../config/database.php';

require __DIR__ . '/../app/Database.php';

$db = new Database($config);

$pdo = $db->connection();

$userId = $_SESSION['user_id'];

/*
|--------------------------------------------------------------------------
| Wallet Balance
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
    SELECT balance
    FROM wallets
    WHERE user_id = :user_id
");

$stmt->execute([
    'user_id' => $userId
]);

$wallet = $stmt->fetch(PDO::FETCH_ASSOC);

$balance = $wallet['balance'] ?? 0;

/*
|--------------------------------------------------------------------------
| Total Funding
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
    SELECT COALESCE(SUM(amount),0) AS total
    FROM transactions
    WHERE user_id = :user_id
    AND type = 'funding'
    AND status = 'successful'
");

$stmt->execute([
    'user_id' => $userId
]);

$totalFunding = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

/*
|--------------------------------------------------------------------------
| Total Spent
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
    SELECT COALESCE(SUM(amount),0) AS total
    FROM transactions
    WHERE user_id = :user_id
    AND type IN ('transfer','airtime','data','cable','electricity')
    AND status = 'successful'
");

$stmt->execute([
    'user_id' => $userId
]);

$totalSpent = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

/*
|--------------------------------------------------------------------------
| Recent Transactions
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
    SELECT
        description,
        amount,
        balance_before,
        balance_after,
        created_at
    FROM transactions
    WHERE user_id = :user_id
    ORDER BY created_at DESC
    LIMIT 20
");

$stmt->execute([
    'user_id' => $userId
]);

$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

/*
|--------------------------------------------------------------------------
| Load View
|--------------------------------------------------------------------------
*/

require __DIR__ . '/../views/wallet.php';
