<?php

class AuthController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    
public function register()
{
    $fullName = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];

    // Basic validation
    if (
        empty($fullName) ||
        empty($username) ||
        empty($email) ||
        empty($phone) ||
        empty($password)
    ) {
        die("All fields are required.");
    }

    // Check if username, email or phone already exists
    $check = $this->pdo->prepare("
        SELECT id
        FROM users
        WHERE username = :username
        OR email = :email
        OR phone = :phone
    ");

    $check->execute([
        'username' => $username,
        'email' => $email,
        'phone' => $phone
    ]);

    if ($check->fetch()) {
        die("Username, Email or Phone already exists.");
    }

    // Hash password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $insert = $this->pdo->prepare("
        INSERT INTO users
        (
            full_name,
            username,
            email,
            phone,
            password_hash
        )
        VALUES
        (
            :full_name,
            :username,
            :email,
            :phone,
            :password_hash
        )
    ");

    $insert->execute([
        'full_name' => $fullName,
        'username' => $username,
        'email' => $email,
        'phone' => $phone,
        'password_hash' => $passwordHash
    ]);

    echo "✅ Registration Successful!";
}
