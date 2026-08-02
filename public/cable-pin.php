<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (
    !isset($_SESSION['cable_provider']) ||
    !isset($_SESSION['cable_smartcard']) ||
    !isset($_SESSION['cable_bouquet']) ||
    !isset($_SESSION['cable_amount']) 
) {
    header("Location: cable.php");
    exit;
}

$config = require __DIR__ . '/../config/database.php';
require __DIR__ . '/../app/Database.php';

$db = new Database($config);
$pdo = $db->connection();

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("
SELECT transaction_pin
FROM users
WHERE id = :id
LIMIT 1
");

$stmt->execute([
    'id' => $userId
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pin = trim($_POST['pin']);

    if (!password_verify($pin, $user['transaction_pin'])) {

        $_SESSION['error'] = "Incorrect Transaction PIN.";

        header("Location: cable-pin.php");
        exit;
    }

    $_SESSION['cable_pin_verified'] = true;

    header("Location: cable-success.php");
    exit;
}

require __DIR__ . '/../views/cable-pin.php';
