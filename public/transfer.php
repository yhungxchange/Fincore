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
| Get Wallet Balance
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
SELECT balance
FROM wallets
WHERE user_id = :user_id
LIMIT 1
");

$stmt->execute([
    'user_id' => $userId
]);

$wallet = $stmt->fetch(PDO::FETCH_ASSOC);

$balance = $wallet['balance'] ?? 0;

/*
|--------------------------------------------------------------------------
| Load View
|--------------------------------------------------------------------------
*/

require __DIR__ . '/../views/transfer.php';
