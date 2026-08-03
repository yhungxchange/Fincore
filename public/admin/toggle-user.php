<?php

session_start();

if(!isset($_SESSION['user_id'])){
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

if(!$admin || !$admin['is_admin']){
    die("Access Denied");
}

/*
|--------------------------------------------------------------------------
| Inputs
|--------------------------------------------------------------------------
*/

$userId = (int)($_GET['id'] ?? 0);

$action = $_GET['action'] ?? '';

$status = ($action === 'unlock') ? true : false;

/*
|--------------------------------------------------------------------------
| Update User Status
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
UPDATE users
SET is_active = :status
WHERE id = :id
");

$stmt->execute([
    "status" => $status,
    "id" => $userId
]);

/*
|--------------------------------------------------------------------------
| Notify User
|--------------------------------------------------------------------------
*/

$title = $status ? "Account Unlocked" : "Account Locked";

$message = $status
? "Your FinCore account has been restored. You can now log in normally."
: "Your FinCore account has been temporarily locked by the administrator.";

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
    "user_id"=>$userId,
    "title"=>$title,
    "message"=>$message
]);

header("Location: view-user.php?id=".$userId);

exit;
