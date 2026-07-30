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

        // Validate input
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
