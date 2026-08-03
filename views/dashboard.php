<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FinCore Dashboard</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">

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

<!-- MAIN -->

<main class="content">

<header class="top-header">

<button id="menuBtn" class="menu-btn">

<i class="fa-solid fa-bars"></i>

</button>

<div class="welcome">

<h1>

Good Afternoon,

<?= htmlspecialchars($_SESSION['username']) ?>

👋

</h1>

<p>

Manage your finances with confidence.

</p>

<div class="notify">

<a href="notifications.php" class="notification-icon">

    <i class="fa-solid fa-bell"></i>

    <?php if($notificationCount > 0): ?>

        <span class="notification-badge">

            <?= $notificationCount ?>

        </span>

    <?php endif; ?>

</a>

</div>

</header>
    
<!-- WALLET BANNER -->

<section class="wallet-card">

<div class="wallet-left">

<p class="wallet-title">

Available Balance

</p>

<div class="wallet-balance-row">

<h2 id="walletBalance">

₦<?= number_format($balance,2) ?>

</h2>

<button id="toggleBalance" class="eye-btn">

<i class="fa-solid fa-eye"></i>

</button>

</div>

<div class="wallet-buttons">

<a href="fund-wallet.php" class="fund-btn">

<i class="fa-solid fa-plus"></i>

Fund Wallet

</a>

<a href="transfer.php" class="transfer-btn">

<i class="fa-solid fa-paper-plane"></i>

Transfer

</a>

</div>

</div>

<div class="wallet-right">

<div class="wallet-circle">

<i class="fa-solid fa-wallet"></i>

</div>

</div>

</section>

<!-- QUICK SERVICES -->

<section class="services">

<h2>

Quick Services

</h2>

<div class="service-grid">

<a href="wallet.php" class="service-card">
<i class="fa-solid fa-wallet"></i>
<span>Wallet</span>
</a>

<a href="fund-wallet.php" class="service-card">
<i class="fa-solid fa-money-bill-wave"></i>
<span>Fund Wallet</span>
</a>

<a href="transfer.php" class="service-card">
<i class="fa-solid fa-money-bill-transfer"></i>
<span>Transfer</span>
</a>

<a href="airtime.php" class="service-card">
<i class="fa-solid fa-mobile-screen"></i>
<span>Airtime</span>
</a>

<a href="data.php" class="service-card">
<i class="fa-solid fa-wifi"></i>
<span>Data</span>
</a>

<a href="cable.php" class="service-card">
<i class="fa-solid fa-tv"></i>
<span>Cable TV</span>
</a>

<a href="electricity.php" class="service-card">
<i class="fa-solid fa-bolt"></i>
<span>Electricity</span>
</a>

<a href="transactions.php" class="service-card">
<i class="fa-solid fa-clock-rotate-left"></i>
<span>Transactions</span>
</a>

</div>

</section>

<!-- ANALYTICS -->

<section class="analytics">

<div class="section-title">

<h2>Wallet Analytics</h2>

<a href="#">Monthly Report</a>

</div>

<div class="analytics-card">

<div class="analytics-placeholder">

<i class="fa-solid fa-chart-line"></i>

<h3>Analytics Coming Soon</h3>

<p>Your wallet activity chart will appear here.</p>

</div>

</div>

</section>

<!-- RECENT TRANSACTIONS -->

<section class="transactions">

<div class="section-title">

<h2>Recent Transactions</h2>

<a href="transactions.php">View All</a>

</div>

<div class="transaction-card">

<div class="transaction">

<div class="left">

<div class="icon green">

<i class="fa-solid fa-money-bill-wave"></i>

</div>

<div>

<h4>Wallet Funding</h4>

<p>No transaction yet</p>

</div>

</div>

<span class="credit">

+ ₦0.00

</span>

</div>

<div class="transaction">

<div class="left">

<div class="icon red">

<i class="fa-solid fa-paper-plane"></i>

</div>

<div>

<h4>Transfer</h4>

<p>No transaction yet</p>

</div>

</div>

<span class="debit">

₦0.00

</span>

</div>

<div class="transaction">

<div class="left">

<div class="icon blue">

<i class="fa-solid fa-mobile-screen"></i>

</div>

<div>

<h4>Airtime Purchase</h4>

<p>No transaction yet</p>

</div>

</div>

<span class="debit">

₦0.00

</span>

</div>

</div>

</section>

</main>

</div>

<script src="/assets/js/dashboard.js"></script>

</body>

</html>
