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

/*
|--------------------------------------------------------------------------
| Money In
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
SELECT COALESCE(SUM(amount),0) AS money_in
FROM transactions
WHERE user_id = :user_id
AND LOWER(type) IN (
'funding',
'transfer in',
'admin_credit'
)
");

$stmt->execute([
    "user_id" => $userId
]);

$moneyIn = (float)$stmt->fetch(PDO::FETCH_ASSOC)['money_in'];

/*
|--------------------------------------------------------------------------
| Money Out
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
SELECT COALESCE(SUM(amount),0) AS money_out
FROM transactions
WHERE user_id = :user_id
AND LOWER(type) IN (
'airtime',
'data',
'data purchase',
'transfer',
'transfer out',
'cable',
'electricity',
'electricity payment',
'admin_debit'
)
");

$stmt->execute([
    "user_id" => $userId
]);

$moneyOut = (float)$stmt->fetch(PDO::FETCH_ASSOC)['money_out'];

/*
|--------------------------------------------------------------------------
| Net Cash Flow
|--------------------------------------------------------------------------
*/

$netFlow = $moneyIn - $moneyOut;

/*
|--------------------------------------------------------------------------
| Load View
|--------------------------------------------------------------------------
*/

require __DIR__ . '/../views/analytics.php';
