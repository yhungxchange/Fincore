<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FinCore Electricity Payment</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/airtime-success.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="dashboard">

<!-- SIDEBAR -->

<aside id="sidebar" class="sidebar">

<div class="logo">

<img src="/assets/images/logo.png">

<h2>FinCore</h2>

</div>

<nav>

<a href="dashboard.php" class="active">
<i class="fa-solid fa-house"></i>
Dashboard
</a>

<a href="wallet.php">
<i class="fa-solid fa-wallet"></i>
Wallet
</a>

<a href="fund-wallet.php">
<i class="fa-solid fa-money-bill-wave"></i>
Fund Wallet
</a>

<a href="transfer.php">
<i class="fa-solid fa-money-bill-transfer"></i>
Transfer
</a>

<a href="airtime.php">
<i class="fa-solid fa-mobile-screen"></i>
Airtime
</a>

<a href="data.php">
<i class="fa-solid fa-wifi"></i>
Data
</a>

<a href="cable.php">
<i class="fa-solid fa-tv"></i>
Cable TV
</a>

<a href="electricity.php">
<i class="fa-solid fa-bolt"></i>
Electricity
</a>

<a href="transactions.php">
<i class="fa-solid fa-clock-rotate-left"></i>
Transactions
</a>

<a href="notifications.php">
<i class="fa-solid fa-bell"></i>
Notifications
</a>

<a href="profile.php">
<i class="fa-solid fa-user"></i>
Profile
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
<h1>Electricity Payment Successful</h1>
<p>Your Electricity Payment was successful.</p>
</div>

<div class="notify">
<i class="fa-solid fa-bell"></i>
</div>

</header>

<section class="success-section">

<div class="success-card">

<div class="success-icon">
<i class="fa-solid fa-circle-check"></i>
</div>

<h2>Purchase Successful</h2>

<p>Your electricity bill payment has been completed successfully.</p>

<div class="summary">

<div class="summary-item">
<span>Electricity Company</span>
<strong><?= htmlspecialchars($disco) ?></strong>
</div>

<div class="summary-item">
<span>Meter Number</span>
<strong><?= htmlspecialchars($meterNumber) ?></strong>
</div>

<div class="summary-item">
<span>Amount</span>
<strong>₦<?= number_format($amount,2) ?></strong>
</div>

<div class="summary-item">
<span>Reference</span>
<strong><?= htmlspecialchars($reference) ?></strong>
</div>

</div>

<a href="transactions.php" class="history-btn">
View Transactions
</a>

<a href="dashboard.php" class="dashboard-btn">
Back to Dashboard
</a>

</div>

</section>

</main>

</div>

<script src="/assets/js/dashboard.js"></script>

</body>
</html>
