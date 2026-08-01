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

$amount = $_POST['amount'] ?? 0;

if ($amount <= 0) {
    header("Location: manual-funding.php");
    exit;
}

$_SESSION['fund_amount'] = $amount;

require __DIR__ . '/../views/confirm-funding.php';
