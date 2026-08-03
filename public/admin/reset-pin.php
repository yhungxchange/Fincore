<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit;
}

$config=require __DIR__.'/../../config/database.php';

require __DIR__.'/../../app/Database.php';

$db=new Database($config);

$pdo=$db->connection();

/*
|--------------------------------------------------------------------------
| Verify Admin
|--------------------------------------------------------------------------
*/

$stmt=$pdo->prepare("
SELECT is_admin
FROM users
WHERE id=:id
LIMIT 1
");

$stmt->execute([
"id"=>$_SESSION['user_id']
]);

$admin=$stmt->fetch(PDO::FETCH_ASSOC);

if(!$admin || !$admin['is_admin']){
    die("Access Denied");
}

/*
|--------------------------------------------------------------------------
| User
|--------------------------------------------------------------------------
*/

$userId=(int)($_GET['id'] ?? 0);

if($userId<=0){
    die("Invalid User");
}

/*
|--------------------------------------------------------------------------
| Reset Transaction PIN
|--------------------------------------------------------------------------
*/

$stmt=$pdo->prepare("
UPDATE users
SET transaction_pin=NULL
WHERE id=:id
");

$stmt->execute([
"id"=>$userId
]);

/*
|--------------------------------------------------------------------------
| Notification
|--------------------------------------------------------------------------
*/

$stmt=$pdo->prepare("
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

"title"=>"Transaction PIN Reset",

"message"=>"Your transaction PIN has been reset by the administrator. Please create a new transaction PIN before making any transaction."

]);

header("Location:view-user.php?id=".$userId);

exit;
