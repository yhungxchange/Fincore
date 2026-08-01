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

$stmt = $pdo->prepare("
SELECT balance
FROM wallets
WHERE user_id = :user_id
LIMIT 1
");

$stmt->execute([
    'user_id' => $_SESSION['user_id']
]);

$wallet = $stmt->fetch(PDO::FETCH_ASSOC);

$balance = $wallet['balance'] ?? 0;

require __DIR__ . '/../views/manual-funding.php';
