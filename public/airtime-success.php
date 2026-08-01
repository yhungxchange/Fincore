<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['airtime_pin_verified'])) {
    header("Location: airtime.php");
    exit;
}

$config = require __DIR__ . '/../config/database.php';
require __DIR__ . '/../app/Database.php';

$db = new Database($config);
$pdo = $db->connection();

$userId = $_SESSION['user_id'];

$network = $_SESSION['airtime_network'];
$phone   = $_SESSION['airtime_phone'];
$amount  = $_SESSION['airtime_amount'];

$wallet = $pdo->prepare("
SELECT balance
FROM wallets
WHERE user_id = :user_id
LIMIT 1
");

$wallet->execute([
    'user_id' => $userId
]);

$wallet = $wallet->fetch(PDO::FETCH_ASSOC);

$balanceBefore = $wallet['balance'];
$balanceAfter  = $balanceBefore - $amount;

if ($balanceAfter < 0) {

    $_SESSION['error'] = "Insufficient Wallet Balance.";

    header("Location: airtime.php");
    exit;
}

$update = $pdo->prepare("
UPDATE wallets
SET balance = :balance
WHERE user_id = :user_id
");

$update->execute([
    'balance' => $balanceAfter,
    'user_id' => $userId
]);

$reference = "FCAIR" . time();

$transaction = $pdo->prepare("
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

$transaction->execute([

'user_id' => $userId,

'type' => 'airtime',

'description' => $network . " Airtime (" . $phone . ")",

'amount' => $amount,

'before' => $balanceBefore,

'after' => $balanceAfter,

'status' => 'Successful',

'reference' => $reference

]);

unset(
$_SESSION['airtime_network'],
$_SESSION['airtime_phone'],
$_SESSION['airtime_amount'],
$_SESSION['airtime_pin_verified']
);

require __DIR__ . '/../views/airtime-success.php';
