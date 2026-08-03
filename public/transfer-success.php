<?php

session_start();

if (!isset($_SESSION['transfer_success'])) {
    header("Location: dashboard.php");
    exit;
}

$data = $_SESSION['transfer_success'];

require __DIR__ . '/../views/transfer-success.php';
