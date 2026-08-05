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

<?php

$stmt = $pdo->prepare("
SELECT
DATE(created_at) AS day,
COALESCE(SUM(
CASE
WHEN LOWER(type) IN (
'funding',
'transfer in',
'admin_credit'
)
THEN amount

WHEN LOWER(type) IN (
'airtime',
'data',
'data purchase',
'transfer',
'transfer out',
'cable',
'electricity',
'electricity payment',
'admin_debit'
)
THEN -amount

ELSE 0
END
),0) AS total

FROM transactions

WHERE user_id = :user_id
AND created_at >= NOW() - INTERVAL '7 days'

GROUP BY DATE(created_at)

ORDER BY day ASC
");

$stmt->execute([
"user_id" => $_SESSION['user_id']
]);

$chartLabels = [];
$chartData = [];

while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $chartLabels[] = date("M d", strtotime($row['day']));
    $chartData[] = (float)$row['total'];
}

?>

/*
|--------------------------------------------------------------------------
| Load Dashboard 
|--------------------------------------------------------------------------
*/

require __DIR__ . '/../views/dashboard.php';
