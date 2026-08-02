<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: electricity.php");
    exit;
}

$_SESSION['electricity_disco'] = $_POST['disco'];
$_SESSION['electricity_meter_type'] = $_POST['meter_type'];
$_SESSION['electricity_meter_number'] = trim($_POST['meter_number']);
$_SESSION['electricity_amount'] = (float)$_POST['amount'];

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

require __DIR__ . '/../views/confirm-electricity.php';
