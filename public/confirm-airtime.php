<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: airtime.php");
    exit;
}

$config = require __DIR__ . '/../config/database.php';
require __DIR__ . '/../app/Database.php';

$db = new Database($config);
$pdo = $db->connection();

$stmt = $pdo->prepare("
SELECT balance
FROM wallets
WHERE user_id = :user_id
LIMIT 1
");

$stmt->execute([
    'user_id' => $_SESSION['user_id']
]);

$wallet = $stmt->fetch(PDO::FETCH_ASSOC);

$balance = $wallet['balance'] ?? 0;

$network = trim($_POST['network']);
$phone = trim($_POST['phone']);
$amount = floatval($_POST['amount']);

if ($amount <= 0) {

    $_SESSION['error']="Invalid Amount.";

    header("Location: airtime.php");

    exit;
}

if ($amount > $balance) {

    $_SESSION['error']="Insufficient Wallet Balance.";

    header("Location: airtime.php");

    exit;
}

$_SESSION['airtime_network']=$network;
$_SESSION['airtime_phone']=$phone;
$_SESSION['airtime_amount']=$amount;

require __DIR__ . '/../views/confirm-airtime.php';
