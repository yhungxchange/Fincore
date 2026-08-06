<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Wallet Analytics</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/analytics.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<div class="dashboard">

<aside id="sidebar" class="sidebar">

<div class="logo">
<img src="/assets/images/logo.png">
<h2>FinCore</h2>
</div>

<nav>

<a href="dashboard.php">
<i class="fa-solid fa-house"></i>
Dashboard
</a>

<a href="wallet.php">
<i class="fa-solid fa-wallet"></i>
Wallet
</a>

<a href="analytics.php" class="active">
<i class="fa-solid fa-chart-pie"></i>
Analytics
</a>

<a href="logout.php">
<i class="fa-solid fa-right-from-bracket"></i>
Logout
</a>

</nav>

</aside>

<main class="content">

<header class="top-header">

<button id="menuBtn" class="menu-btn">

<i class="fa-solid fa-bars"></i>

</button>

<div class="welcome">

<h1>Wallet Analytics</h1>

<p>Income vs Spending Overview</p>

</div>

</header>

<div class="analytics-wrapper">

<!-- LEFT -->

<div class="chart-card">

<h2>Donut Chart</h2>

<p>Income vs Spending</p>

<canvas id="walletDonut"></canvas>

</div>

<!-- RIGHT -->

<div class="summary-card">

<div class="money-row income">

<div>

<div class="dot green"></div>

<h3>Money In</h3>

<p>Funding + incoming transfers</p>

</div>

<h2>
₦<?= number_format($moneyIn,2) ?>
</h2>

</div>

<hr>

<div class="money-row expense">

<div>

<div class="dot red"></div>

<h3>Money Out</h3>

<p>Airtime, data, bills & transfers</p>

</div>

<h2>
₦<?= number_format($moneyOut,2) ?>
</h2>

</div>

<hr>

<div class="cash-flow">

<h2>Net Cash Flow</h2>

<h1>
₦<?= number_format($cashFlow,2) ?>
</h1>

<p>

<?= $cashFlow >= 0

? "You received more than you spent."

: "You spent more than you received."

?>

</p>

</div>

</div>

</div>

</main>

</div>

<script src="/assets/js/dashboard.js"></script>

</body>

</html>
