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

$id=$_GET['id'] ?? 0;

$stmt=$pdo->prepare("

SELECT

u.*,

w.balance

FROM users u

LEFT JOIN wallets w

ON u.id=w.user_id

WHERE u.id=:id

LIMIT 1

");

$stmt->execute([

"id"=>$id

]);

$user=$stmt->fetch(PDO::FETCH_ASSOC);

if(!$user){

die("User not found.");

}

require __DIR__.'/../../views/admin-view-user.php';
