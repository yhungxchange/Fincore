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

$user_id = $_SESSION['user_id'];

$recipient_id = intval($_POST['recipient_id'] ?? 0);
$amount       = floatval($_POST['amount'] ?? 0);
$narration    = trim($_POST['narration'] ?? '');

if ($recipient_id <= 0) {

    $_SESSION['error'] = "Invalid recipient.";

    header("Location: transfer.php");

    exit;
}

if ($amount < 100) {

    $_SESSION['error'] = "Minimum transfer is ₦100.";

    header("Location: transfer.php");

    exit;
}


/*
|--------------------------------------------------------------------------
| Sender
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
SELECT id, full_name, wallet_balance
FROM users
WHERE id = ?
LIMIT 1
");

$stmt->execute([$user_id]);

$sender = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$sender) {

    $_SESSION['error'] = "Sender account not found.";

    header("Location: transfer.php");

    exit;
}


/*
|--------------------------------------------------------------------------
| Balance Check
|--------------------------------------------------------------------------
*/

if ($sender['wallet_balance'] < $amount) {

    $_SESSION['error'] = "Insufficient wallet balance.";

    header("Location: transfer.php");

    exit;
}


/*
|--------------------------------------------------------------------------
| Recipient
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
SELECT id, full_name, username, email
FROM users
WHERE id = ?
LIMIT 1
");

$stmt->execute([$recipient_id]);

$recipient = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$recipient) {

    $_SESSION['error'] = "Recipient not found.";

    header("Location: transfer.php");

    exit;
}

$_SESSION['transfer'] = [

    'recipient_id' => $recipient['id'],

    'recipient_name' => $recipient['full_name'],

    'recipient_username' => $recipient['username'],

    'recipient_email' => $recipient['email'],

    'amount' => $amount,

    'narration' => $narration

];

include __DIR__ . '/../views/confirm-transfer.php';
