<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['transfer_success'])) {
    header("Location: dashboard.php");
    exit;
}

require __DIR__ . '/../views/transfer-success.php';
