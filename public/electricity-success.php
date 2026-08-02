<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (
    !isset($_SESSION['electricity_pin_verified']) ||
    !$_SESSION['electricity_pin_verified']
) {
    header("Location: electricity-pin.php");
    exit;
}

$config = require __DIR__ . '/../config/database.php';
require __DIR__ . '/../app/Database.php';

$db = new Database($config);
$pdo = $db->connection();

$userId = $_SESSION['user_id'];

$disco = $_SESSION['electricity_disco'];
$meterType = $_SESSION['electricity_meter_type'];
$meterNumber = $_SESSION['electricity_meter_number'];
$amount = (float)$_SESSION['electricity_amount'];

$stmt = $pdo->prepare("
SELECT balance
FROM wallets
WHERE user_id = :user_id
LIMIT 1
");

$stmt->execute([
    'user_id' => $userId
]);

$wallet = $stmt->fetch(PDO::FETCH_ASSOC);

$balanceBefore = (float)$wallet['balance'];

if ($balanceBefore < $amount) {

    $_SESSION['error'] = "Insufficient Wallet Balance.";

    header("Location: electricity.php");
    exit;
}

$balanceAfter = $balanceBefore - $amount;

$pdo->beginTransaction();

try {

    $update = $pdo->prepare("
    UPDATE wallets
    SET balance = :balance
    WHERE user_id = :user_id
    ");

    $update->execute([
        'balance' => $balanceAfter,
        'user_id' => $userId
    ]);

    $reference = "ELEC" . time() . rand(1000,9999);

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

        'user_id' => $userId,

        'type' => 'Electricity',

        'description' => "$disco $meterType ($meterNumber)",

        'amount' => $amount,

        'balance_before' => $balanceBefore,

        'balance_after' => $balanceAfter,

        'status' => 'Successful',

        'reference' => $reference

    ]);

    $pdo->commit();

} catch(Exception $e){

    $pdo->rollBack();

    die($e->getMessage());

}

unset(
    $_SESSION['electricity_disco'],
    $_SESSION['electricity_meter_type'],
    $_SESSION['electricity_meter_number'],
    $_SESSION['electricity_amount'],
    $_SESSION['electricity_pin_verified']
);

require __DIR__ . '/../views/electricity-success.php';
