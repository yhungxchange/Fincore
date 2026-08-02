<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['transfer'])) {
    header("Location: transfer.php");
    exit;
}

$config = require __DIR__ . '/../config/database.php';
require __DIR__ . '/../app/Database.php';

$db = new Database($config);
$pdo = $db->connection();

$user_id = $_SESSION['user_id'];
$pin = trim($_POST['pin'] ?? '');

if ($pin == "") {

    $_SESSION['error'] = "Enter your transaction PIN.";

    header("Location: transfer-pin.php");

    exit;
}


/*
|--------------------------------------------------------------------------
| Load Sender Information
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
SELECT
    u.id,
    u.full_name,
    u.transaction_pin,
    w.balance
FROM users u
JOIN wallets w
ON u.id = w.user_id
WHERE u.id = :user_id
LIMIT 1
");

$stmt->execute([
    "user_id" => $user_id
]);

$sender = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$sender) {
    die("Sender account not found.");
}


/*
|--------------------------------------------------------------------------
| Verify Transaction PIN
|--------------------------------------------------------------------------
*/

if (!password_verify($pin, $sender['transaction_pin'])) {

    $_SESSION['error'] = "Incorrect transaction PIN.";

    header("Location: transfer-pin.php");

    exit;
}


/*
|--------------------------------------------------------------------------
| Load Transfer Details
|--------------------------------------------------------------------------
*/

$recipient_id = $_SESSION['transfer']['recipient_id'];

$amount = floatval($_SESSION['transfer']['amount']);

$narration = $_SESSION['transfer']['narration'];


/*
|--------------------------------------------------------------------------
| Check Wallet Balance
|--------------------------------------------------------------------------
*/

if ($sender['balance'] < $amount) {

    $_SESSION['error'] = "Insufficient wallet balance.";

    header("Location: transfer.php");

    exit;
}

echo "PIN VERIFIED ✅";
