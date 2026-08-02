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
| Sender Details
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
| Transfer Details
|--------------------------------------------------------------------------
*/

$recipient_id = $_SESSION['transfer']['recipient_id'];

$recipient_name = $_SESSION['transfer']['recipient_name'];

$amount = floatval($_SESSION['transfer']['amount']);

$narration = trim($_SESSION['transfer']['narration']);

/*
|--------------------------------------------------------------------------
| Check Sender Balance
|--------------------------------------------------------------------------
*/

$balance_before_sender = floatval($sender['balance']);

if ($balance_before_sender < $amount) {

    $_SESSION['error'] = "Insufficient wallet balance.";

    header("Location: transfer.php");

    exit;
}

/*
|--------------------------------------------------------------------------
| Recipient Wallet
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
SELECT
    u.id,
    u.full_name,
    w.balance
FROM users u
JOIN wallets w
ON u.id = w.user_id
WHERE u.id = :recipient_id
LIMIT 1
");

$stmt->execute([
    "recipient_id" => $recipient_id
]);

$recipient = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$recipient) {

    $_SESSION['error'] = "Recipient account not found.";

    header("Location: transfer.php");

    exit;
}

$balance_before_recipient = floatval($recipient['balance']);

$balance_after_sender = $balance_before_sender - $amount;

$balance_after_recipient = $balance_before_recipient + $amount;

/*
|--------------------------------------------------------------------------
| Generate Reference
|--------------------------------------------------------------------------
*/

$reference = "TRF".time().rand(100,999);

/*
|--------------------------------------------------------------------------
| Begin Transaction
|--------------------------------------------------------------------------
*/

try {

    $pdo->beginTransaction();

/*
|--------------------------------------------------------------------------
| Deduct Sender Wallet
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
UPDATE wallets
SET balance = :balance
WHERE user_id = :user_id
");

$stmt->execute([
    "balance" => $balance_after_sender,
    "user_id" => $user_id
]);


/*
|--------------------------------------------------------------------------
| Credit Recipient Wallet
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
UPDATE wallets
SET balance = :balance
WHERE user_id = :user_id
");

$stmt->execute([
    "balance" => $balance_after_recipient,
    "user_id" => $recipient_id
]);


/*
|--------------------------------------------------------------------------
| Sender Transaction
|--------------------------------------------------------------------------
*/

$transaction = $pdo->prepare("
INSERT INTO transactions
(
    user_id,
    type,
    description,
    amount,
    balance_before,
    balance_after,
    status,
    reference,
    created_at,
    updated_at
)
VALUES
(
    :user_id,
    :type,
    :description,
    :amount,
    :balance_before,
    :balance_after,
    :status,
    :reference,
    NOW(),
    NOW()
)
");

$transaction->execute([

    "user_id" => $user_id,

    "type" => "Transfer Out",

    "description" => "Transfer to ".$recipient_name,

    "amount" => $amount,

    "balance_before" => $balance_before_sender,

    "balance_after" => $balance_after_sender,

    "status" => "Successful",

    "reference" => $reference

]);


/*
|--------------------------------------------------------------------------
| Recipient Transaction
|--------------------------------------------------------------------------
*/

$transaction->execute([

    "user_id" => $recipient_id,

    "type" => "Transfer In",

    "description" => "Transfer from ".$sender['full_name'],

    "amount" => $amount,

    "balance_before" => $balance_before_recipient,

    "balance_after" => $balance_after_recipient,

    "status" => "Successful",

    "reference" => $reference

]);

/*
|--------------------------------------------------------------------------
| Commit Transaction
|--------------------------------------------------------------------------
*/

$pdo->commit();

/*
|--------------------------------------------------------------------------
| Clear Transfer Session
|--------------------------------------------------------------------------
*/

unset($_SESSION['transfer']);

/*
|--------------------------------------------------------------------------
| Save Success Details
|--------------------------------------------------------------------------
*/

$_SESSION['transfer_success'] = [

    "recipient_name" => $recipient_name,

    "amount" => $amount,

    "reference" => $reference,

    "narration" => $narration

];

/*
|--------------------------------------------------------------------------
| Redirect
|--------------------------------------------------------------------------
*/

header("Location: transfer-success.php");

exit;

} catch (Exception $e) {

/*
|--------------------------------------------------------------------------
| Rollback
|--------------------------------------------------------------------------
*/

catch (Exception $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    die($e->getMessage());

}
