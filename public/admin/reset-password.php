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
    SELECT is_admin
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
| User ID
|--------------------------------------------------------------------------
*/

$userId = (int)($_GET['id'] ?? 0);

if ($userId <= 0) {
    die("Invalid User");
}

/*
|--------------------------------------------------------------------------
| Generate Temporary Password
|--------------------------------------------------------------------------
*/

$tempPassword = strtoupper(substr(bin2hex(random_bytes(6)), 0, 8));

$passwordHash = password_hash($tempPassword, PASSWORD_DEFAULT);

/*
|--------------------------------------------------------------------------
| Update User Password
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
    UPDATE users
    SET password_hash = :password
    WHERE id = :id
");

$stmt->execute([
    "password" => $passwordHash,
    "id" => $userId
]);

/*
|--------------------------------------------------------------------------
| Notify User
|--------------------------------------------------------------------------
*/

$title = "Login Password Reset";

$message = "Your FinCore login password has been reset by the administrator. Please change your login password to ensure account safety.";

$stmt = $pdo->prepare("
    INSERT INTO notifications
    (
        user_id,
        title,
        message,
        type
    )
    VALUES
    (
        :user_id,
        :title,
        :message,
        'security'
    )
");

$stmt->execute([
    "user_id" => $userId,
    "title" => $title,
    "message" => $message
]);

/*
|--------------------------------------------------------------------------
| Store Temporary Password For Popup
|--------------------------------------------------------------------------
*/

$_SESSION['temp_password'] = $tempPassword;

header("Location: view-user.php?id=" . $userId);

exit;
