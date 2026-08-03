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
| Wallet Balance
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
    SELECT balance
    FROM wallets
    WHERE user_id = :user_id
");

$stmt->execute([
    'user_id' => $_SESSION['user_id']
]);

$wallet = $stmt->fetch(PDO::FETCH_ASSOC);

if ($wallet) {

    $balance = $wallet['balance'];

} else {

    $balance = 0;

}


/*
|--------------------------------------------------------------------------
| Unread Notifications
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
    SELECT COUNT(*) AS total
    FROM notifications
    WHERE user_id = :user_id
    AND is_read = FALSE
");

$stmt->execute([
    'user_id' => $_SESSION['user_id']
]);

$notification = $stmt->fetch(PDO::FETCH_ASSOC);

$notificationCount = $notification['total'] ?? 0;


/*
|--------------------------------------------------------------------------
| Load Dashboard
|--------------------------------------------------------------------------
*/

require __DIR__ . '/../views/dashboard.php';
