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
        $password = $_POST['password'];$errors = [];

 if (empty($fullName)) {
    $errors['full_name'] = "Full name is required.";
}

if (empty($username)) {
    $errors['username'] = "Username is required.";
}

if (empty($email)) {
    $errors['email'] = "Email is required.";
}

if (empty($phone)) {
    $errors['phone'] = "Phone number is required.";
}

if (empty($password)) {
    $errors['password'] = "Password is required.";
}

        // Full name validation
        if (strlen($fullName) < 5) {
            $errors['full_name'] = "Full name must be at least 5 characters.";
        }

        // Username validation
        if (strlen($username) < 5) {
            $errors['username'] = "Username must be at least 5 characters.";
        }

        // Email validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Please enter a valid email address.";
        }

        // Phone validation
        if (strlen($phone) < 11 || strlen($phone) > 14) {
            $errors['phone'] = "Phone number must contain between 11 and 14 digits.";
        }

        // Password validation
        if (strlen($password) < 5) {
            $errors['password'] = "Password must be at least 5 characters.";
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
    $errors['general'] = "Username, Email or Phone already exists.";
        }

        // Hash password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if (!empty($errors)) {

    $_SESSION['errors'] = $errors;

    $_SESSION['old'] = [
        'full_name' => $fullName,
        'username'  => $username,
        'email'     => $email,
        'phone'     => $phone
    ];

    header("Location: register.php");
    exit;
        }

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

    $errors = [];

    // Validate Email
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    // Validate Password
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    }

    // Save old input
    $_SESSION['old'] = [
        'email' => $email
    ];

    // Return validation errors
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: login.php");
        exit;
    }

    // Find user
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

    // Invalid login
    if (!$user || !password_verify($password, $user['password_hash'])) {

        $_SESSION['errors'] = [
            'general' => "Invalid email or password."
        ];

        header("Location: login.php");
        exit;
    }

    // Login successful
    unset($_SESSION['errors']);
    unset($_SESSION['old']);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];

    header("Location: dashboard.php");
    exit;
}
}
