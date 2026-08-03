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
| Check Admin
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
SELECT
id,
full_name,
username,
email,
is_admin
FROM users
WHERE id = :user_id
LIMIT 1
");

$stmt->execute([

"user_id" => $_SESSION['user_id']

]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !$user['is_admin']) {

die("❌ Access Denied.");

}

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

require __DIR__ . '/../../views/admin-dashboard.php';
