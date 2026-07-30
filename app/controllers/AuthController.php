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
        $phone = preg_replace('/\D/', '', trim($_POST['phone']));
        $password = $_POST['password'];

        // Required fields
        if (
            empty($fullName) ||
            empty($username) ||
            empty($email) ||
            empty($phone) ||
            empty($password)
        ) {
            die("All fields are required.");
        }

        // Full name validation
        if (strlen($fullName) < 5) {
            die("Full name must be at least 5 characters.");
        }

        // Username validation
        if (strlen($username) < 5) {
            die("Username must be at least 5 characters.");
        }

        // Email validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Please enter a valid email address.");
        }

        // Phone validation
        if (strlen($phone) < 11 || strlen($phone) > 14) {
            die("Phone number must contain between 11 and 14 digits.");
        }

        // Password validation
        if (strlen($password) < 5) {
            die("Password must be at least 5 characters.");
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
            RETURNING id
        ");

        $insert->execute([
            'full_name' => $fullName,
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'password_hash' => $passwordHash
        ]);

        // Get new user ID
        $userId = $insert->fetchColumn();

        // Create wallet automatically
        $wallet = $this->pdo->prepare("
            INSERT INTO wallets
            (
                user_id,
                balance
            )
            VALUES
            (
                :user_id,
                0.00
            )
        ");

        $wallet->execute([
            'user_id' => $userId
        ]);

        // Redirect to login
        header("Location: login.php");
        exit;
    }

    public function login()
    {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            die("Email and Password are required.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Please enter a valid email address.");
        }

        $stmt = $this->pdo->prepare("
            SELECT *
            FROM users
            WHERE email = :email
            LIMIT 1
        ");

        $stmt->execute([
            'email' => $email
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            die("Invalid Email or Password.");
        }

        if (!password_verify($password, $user['password_hash'])) {
            die("Invalid Email or Password.");
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("Location: dashboard.php");
        exit;
    }
}
