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

$stmt = $pdo->prepare("
SELECT
    full_name,
    username,
    email,
    phone,
    created_at,
    transaction_pin
FROM users
WHERE id = :id
LIMIT 1
");

$stmt->execute([
    'id' => $userId
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

require __DIR__ . '/../views/profile.php';
