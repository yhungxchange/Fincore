<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: data.php");
    exit;
}

$_SESSION['data_network'] = $_POST['network'];
$_SESSION['data_type']    = $_POST['data_type'];
list($planName, $planPrice) = explode('|', $_POST['plan']);

$_SESSION['data_plan'] = $planName;
$_SESSION['data_amount'] = $planPrice;
$_SESSION['data_phone']   = trim($_POST['phone']);

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

require __DIR__ . '/../views/confirm-data.php';
