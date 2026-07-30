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
            'username' => $username,
            'email' => $email,
            'phone' => $phone
        ]);

        if ($check->fetch()) {
            die("Username, Email or Phone already exists.");
        }

        // Hash password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Insert user and return the new ID
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

        // Get the newly created user ID
        $userId = $insert->fetchColumn();

        // Automatically create wallet
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
