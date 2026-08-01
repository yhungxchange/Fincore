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

if (!isset($_SESSION['fund_amount'])) {
    header("Location: manual-funding.php");
    exit;
}

$amount = $_SESSION['fund_amount'];

$stmt = $pdo->prepare("
SELECT
    full_name,
    transaction_pin
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

        header("Location: transaction-pin.php");
        exit;
    }

    /*
    Wallet Update
    comes next
    */

    $_SESSION['pin_verified'] = true;

    header("Location: funding-success.php");

    exit;
}

require __DIR__ . '/../views/transaction-pin.php';
