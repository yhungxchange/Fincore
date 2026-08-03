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
SELECT *
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
| Load Users
|--------------------------------------------------------------------------
*/

$search = trim($_GET['search'] ?? '');

$stmt = $pdo->prepare("
SELECT
u.id,
u.full_name,
u.username,
u.email,
u.phone,
w.balance,
u.created_at
FROM users u
LEFT JOIN wallets w
ON u.id = w.user_id
WHERE
u.full_name ILIKE :search
OR u.username ILIKE :search
OR u.email ILIKE :search
OR u.phone ILIKE :search
ORDER BY u.id DESC
");

$stmt->execute([
    "search" => "%{$search}%"
]);

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

require __DIR__ . '/../../views/admin-users.php';
