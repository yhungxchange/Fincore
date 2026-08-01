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
    password_hash
FROM users
WHERE id = :id
LIMIT 1
");

$stmt->execute([
    'id' => $userId
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if (!password_verify($currentPassword, $user['password_hash'])) {

        $_SESSION['error'] = "Current password is incorrect.";

        header("Location: change-password.php");
        exit;
    }

    if (
    strlen($newPassword) < 5 ||
    !preg_match('/[A-Z]/', $newPassword) ||
    !preg_match('/[a-z]/', $newPassword) ||
    !preg_match('/[0-9]/', $newPassword)
) {

    $_SESSION['error'] = "Password must be at least 5 characters and contain an uppercase letter, lowercase letter and a number.";

    header("Location: change-password.php");
    exit;
    
    }

    if ($newPassword !== $confirmPassword) {

        $_SESSION['error'] = "Passwords do not match.";

        header("Location: change-password.php");
        exit;
    }

    $hash = password_hash($newPassword, PASSWORD_DEFAULT);

    $update = $pdo->prepare("
    UPDATE users
    SET password_hash = :password
    WHERE id = :id
    ");

    $update->execute([
        'password' => $hash,
        'id' => $userId
    ]);

    $_SESSION['success'] = "Password changed successfully.";

    header("Location: profile.php");
    exit;
}

require __DIR__ . '/../views/change-password.php';
