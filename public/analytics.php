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


/*
|--------------------------------------------------------------------------
| MONEY IN
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
SELECT COALESCE(SUM(amount),0) total
FROM transactions
WHERE user_id=:user_id
AND LOWER(type) IN(
'funding',
'transfer in',
'admin_credit'
)
");

$stmt->execute([
"user_id"=>$userId
]);

$moneyIn = (float)$stmt->fetch(PDO::FETCH_ASSOC)['total'];


/*
|--------------------------------------------------------------------------
| MONEY OUT
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
SELECT COALESCE(SUM(amount),0) total
FROM transactions
WHERE user_id=:user_id
AND LOWER(type) IN(
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
");

$stmt->execute([
"user_id"=>$userId
]);

$moneyOut = (float)$stmt->fetch(PDO::FETCH_ASSOC)['total'];


/*
|--------------------------------------------------------------------------
| NET CASH FLOW
|--------------------------------------------------------------------------
*/

$cashFlow = $moneyIn - $moneyOut;

/*
|--------------------------------------------------------------------------
| SPENDING BREAKDOWN
|--------------------------------------------------------------------------
*/

function getTotal(PDO $pdo, $userId, array $types)
{
    $placeholders = implode(",", array_fill(0, count($types), "?"));

    $sql = "
    SELECT
        COALESCE(SUM(amount),0) total,
        COUNT(*) total_count
    FROM transactions
    WHERE user_id=?
    AND LOWER(type) IN ($placeholders)
    ";

    $stmt = $pdo->prepare($sql);

    $params = array_merge([$userId], array_map('strtolower',$types));

    $stmt->execute($params);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


/*
|--------------------------------------------------------------------------
| Individual Categories
|--------------------------------------------------------------------------
*/

$dataStats = getTotal($pdo,$userId,[
'data',
'data purchase'
]);

$airtimeStats = getTotal($pdo,$userId,[
'airtime'
]);

$transferStats = getTotal($pdo,$userId,[
'transfer',
'transfer out'
]);

$billsStats = getTotal($pdo,$userId,[
'cable',
'electricity',
'electricity payment'
]);


/*
|--------------------------------------------------------------------------
| Percentages
|--------------------------------------------------------------------------
*/

$totalSpent = $moneyOut;

$dataPercent = $totalSpent>0 ? round(($dataStats['total']/$totalSpent)*100) : 0;

$airtimePercent = $totalSpent>0 ? round(($airtimeStats['total']/$totalSpent)*100) : 0;

$transferPercent = $totalSpent>0 ? round(($transferStats['total']/$totalSpent)*100) : 0;

$billsPercent = $totalSpent>0 ? round(($billsStats['total']/$totalSpent)*100) : 0;


/*
|--------------------------------------------------------------------------
| Biggest Expense
|--------------------------------------------------------------------------
*/

$expenses = [

'Data'=>$dataStats['total'],

'Airtime'=>$airtimeStats['total'],

'Transfer'=>$transferStats['total'],

'Bills'=>$billsStats['total']

];

arsort($expenses);

$biggestExpenseName = key($expenses);

$biggestExpenseAmount = current($expenses);


/*
|--------------------------------------------------------------------------
| Most Used Service
|--------------------------------------------------------------------------
*/

$services=[

'Data'=>$dataStats['total_count'],

'Airtime'=>$airtimeStats['total_count'],

'Transfer'=>$transferStats['total_count'],

'Bills'=>$billsStats['total_count']

];

arsort($services);

$mostUsedService = key($services);

$mostUsedCount = current($services);

/*
|--------------------------------------------------------------------------
| LOAD VIEW
|--------------------------------------------------------------------------
*/

require __DIR__ . '/../views/analytics.php';
