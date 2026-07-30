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

$stmt = $pdo->prepare("
    SELECT balance
    FROM wallets
    WHERE user_id = :user_id
    LIMIT 1
");

$stmt->execute([
    'user_id' => $_SESSION['user_id']
]);

$wallet = $stmt->fetch(PDO::FETCH_ASSOC);

$balance = $wallet ? $wallet['balance'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FinCore Dashboard</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}

body{
background:#f5f7fb;
padding:20px;
}

.container{
max-width:900px;
margin:auto;
}

.header{
background:#0d6efd;
color:white;
padding:20px;
border-radius:15px;
margin-bottom:20px;
}

.header h2{
font-size:28px;
}

.wallet{
background:white;
padding:25px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
margin-bottom:20px;
}

.wallet p{
color:gray;
font-size:18px;
}

.wallet h1{
margin-top:10px;
font-size:40px;
color:#0d6efd;
}

.actions{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(140px,1fr));
gap:15px;
}

.actions button{
padding:18px;
border:none;
border-radius:10px;
background:#0d6efd;
color:white;
font-size:16px;
cursor:pointer;
transition:.3s;
}

.actions button:hover{
background:#0b5ed7;
}

.logout{
margin-top:20px;
}

.logout button{
width:100%;
padding:18px;
border:none;
border-radius:10px;
background:#dc3545;
color:white;
font-size:17px;
cursor:pointer;
}

.logout button:hover{
background:#bb2d3b;
}

@media(max-width:600px){

.header h2{
font-size:22px;
}

.wallet h1{
font-size:32px;
}

}

</style>

</head>

<body>

<div class="container">

<div class="header">

<h2>
Welcome back,
<?= htmlspecialchars($_SESSION['username']) ?>
👋
</h2>

</div>

<div class="wallet">

<p>Wallet Balance</p>

<h1>
₦<?= number_format($balance,2) ?>
</h1>

</div>

<div class="actions">

<button>💰 Deposit</button>

<button>💸 Transfer</button>

<button>📱 Buy Data</button>

<button>📞 Airtime</button>

<button>📜 Transactions</button>

<button>👤 Profile</button>

</div>

<div class="logout">

<button onclick="window.location.href='logout.php'">
🚪 Logout
</button>

</div>

</div>

</body>
</html>
