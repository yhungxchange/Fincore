<?php

session_start();

if (!isset($_SESSION['locked_message'])) {
    header("Location: login.php");
    exit;
}

$message = $_SESSION['locked_message'];

unset($_SESSION['locked_message']);

require __DIR__ . '/../views/account-locked.php';
