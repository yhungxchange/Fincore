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
SELECT *
FROM notifications
WHERE user_id = :user_id
ORDER BY created_at DESC
");

$stmt->execute([
    "user_id" => $_SESSION['user_id']
]);

$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

require __DIR__ . '/../views/notifications.php';
