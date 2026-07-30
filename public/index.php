<?php

$config = require __DIR__ . '/../config/database.php';

require __DIR__ . '/../app/Database.php';

$db = new Database($config);

$pdo = $db->connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fullName = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];

    echo "<pre>";

    print_r([
        "Full Name" => $fullName,
        "Username" => $username,
        "Email" => $email,
        "Phone" => $phone,
        "Password" => $password
    ]);

    echo "</pre>";

    exit;
}

require __DIR__ . '/../views/register.php';
