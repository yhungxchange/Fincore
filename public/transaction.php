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

$filter = $_GET['type'] ?? 'all';

if ($filter === 'all') {

    $stmt = $pdo->prepare("
        SELECT *
        FROM transactions
        WHERE user_id = :user_id
        ORDER BY created_at DESC
    ");

    $stmt->execute([
        'user_id' => $userId
    ]);

} else {

    $stmt = $pdo->prepare("
        SELECT *
        FROM transactions
        WHERE user_id = :user_id
        AND type = :type
        ORDER BY created_at DESC
    ");

    $stmt->execute([
        'user_id' => $userId,
        'type' => $filter
    ]);

}

$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

require __DIR__ . '/../views/transactions.php';
