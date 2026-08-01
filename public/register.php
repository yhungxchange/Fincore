<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$config = require __DIR__ . '/../config/database.php';

require __DIR__ . '/../app/Database.php';
require __DIR__ . '/../app/controllers/AuthController.php';

$db = new Database($config);

$pdo = $db->connection();

$auth = new AuthController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth->register();
}

require __DIR__ . '/../views/register.php';
