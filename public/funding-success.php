<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['success'])) {
    header("Location: wallet.php");
    exit;
}

$message = $_SESSION['success'];
$amount = $_SESSION['funding_amount'];
$reference = $_SESSION['funding_reference'];

unset($_SESSION['success']);
unset($_SESSION['funding_amount']);
unset($_SESSION['funding_reference']);

require __DIR__ . '/../views/funding-success.php';
