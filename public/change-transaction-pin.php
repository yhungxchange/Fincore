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

    $currentPin = trim($_POST['current_pin']);
    $newPin = trim($_POST['new_pin']);
    $confirmPin = trim($_POST['confirm_pin']);

    // Verify current PIN
    if (!password_verify($currentPin, $user['transaction_pin'])) {

        $_SESSION['error'] = "Current Transaction PIN is incorrect.";

        header("Location: change-transaction-pin.php");
        exit;
    }

    // PIN must be exactly 4 digits
    if (!preg_match('/^[0-9]{4}$/', $newPin)) {

        $_SESSION['error'] = "Transaction PIN must be exactly 4 digits.";

        header("Location: change-transaction-pin.php");
        exit;
    }

    // Confirm PIN
    if ($newPin !== $confirmPin) {

        $_SESSION['error'] = "Transaction PINs do not match.";

        header("Location: change-transaction-pin.php");
        exit;
    }

    $hash = password_hash($newPin, PASSWORD_DEFAULT);

    $update = $pdo->prepare("
    UPDATE users
    SET transaction_pin = :pin
    WHERE id = :id
    ");

    $update->execute([
        'pin' => $hash,
        'id' => $userId
    ]);

    $_SESSION['success'] = "Transaction PIN changed successfully.";

    header("Location: profile.php");
    exit;
}

require __DIR__ . '/../views/change-transaction-pin.php';
