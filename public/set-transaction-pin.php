<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$config = require __DIR__ . '/../config/database.php';
require __DIR__ . '/../app/Database.php';

$db = new Database($config);
$pdo = $db->connection();

/*
|--------------------------------------------------------------------------
| Admin PIN Reset Message
|--------------------------------------------------------------------------
*/

$message = "";

if (isset($_SESSION['pin_reset'])) {

    $message = "🔐 Your Transaction PIN has been reset by the administrator. Please create a new Transaction PIN to continue.";

    unset($_SESSION['pin_reset']);

}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pin = trim($_POST['pin']);
    $confirmPin = trim($_POST['confirm_pin']);

    if (!preg_match('/^\d{4}$/', $pin)) {
        $_SESSION['error'] = "PIN must be exactly 4 digits.";
        header("Location: set-transaction-pin.php");
        exit;
    }

    if ($pin !== $confirmPin) {
        $_SESSION['error'] = "PINs do not match.";
        header("Location: set-transaction-pin.php");
        exit;
    }

    $hashedPin = password_hash($pin, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        UPDATE users
        SET transaction_pin = :pin
        WHERE id = :id
    ");

    $stmt->execute([
        'pin' => $hashedPin,
        'id' => $userId
    ]);

    $_SESSION['success'] = "Transaction PIN created successfully.";

    header("Location: dashboard.php");
    exit;
}

$pinResetMessage = $message;

require __DIR__ . '/../views/set-transaction-pin.php';
