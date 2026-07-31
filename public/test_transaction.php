<?php

session_start();

$config = require __DIR__ . '/../config/database.php';
require __DIR__ . '/../app/Database.php';

$db = new Database($config);
$pdo = $db->connection();

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("
INSERT INTO transactions
(
user_id,
type,
description,
amount,
balance_before,
balance_after,
status,
reference
)
VALUES
(
:user_id,
:type,
:description,
:amount,
:before,
:after,
:status,
:reference
)
");

$stmt->execute([

'user_id'=>$userId,

'type'=>'funding',

'description'=>'Wallet Funding',

'amount'=>5000,

'before'=>0,

'after'=>5000,

'status'=>'successful',

'reference'=>'TXN'.time()

]);

echo "✅ Test transaction inserted successfully.";
