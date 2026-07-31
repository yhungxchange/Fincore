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

<aside class="sidebar" id="sidebar">

<div class="logo-box">

<img src="/assets/images/logo.png" class="logo">

<h2>FinCore</h2>

</div>

<ul class="sidebar-menu">

<li>

<a href="dashboard.php" class="active">

<i class="fa-solid fa-house"></i>

<span>Dashboard</span>

</a>

</li>

<li>

<a href="wallet.php">

<i class="fa-solid fa-wallet"></i>

<span>Wallet</span>

</a>

</li>

<li>

<a href="fund-wallet.php">

<i class="fa-solid fa-money-bill-wave"></i>

<span>Fund Wallet</span>

</a>

</li>

<li>

<a href="transfer.php">

<i class="fa-solid fa-money-bill-transfer"></i>

<span>Transfer</span>

</a>

</li>

<li>

<a href="airtime.php">

<i class="fa-solid fa-mobile-screen-button"></i>

<span>Airtime</span>

</a>

</li>

<li>

<a href="data.php">

<i class="fa-solid fa-wifi"></i>

<span>Data</span>

</a>

</li>

<li>

<a href="cable.php">

<i class="fa-solid fa-tv"></i>

<span>Cable TV</span>

</a>

</li>

<li>

<a href="electricity.php">

<i class="fa-solid fa-bolt"></i>

<span>Electricity</span>

</a>

</li>

<li>

<a href="transactions.php">

<i class="fa-solid fa-clock-rotate-left"></i>

<span>Transactions</span>

</a>

</li>

<li>

<a href="notifications.php">

<i class="fa-solid fa-bell"></i>

<span>Notifications</span>

</a>

</li>

<li>

<a href="profile.php">

<i class="fa-solid fa-user"></i>

<span>Profile</span>

</a>

</li>

<li>

<a href="logout.php">

<i class="fa-solid fa-right-from-bracket"></i>

<span>Logout</span>

</a>

</li>

</ul>

</aside>

<!-- MAIN -->

<div class="main">

<header class="topbar">

<button id="menuBtn" class="menu-btn">

<i class="fa-solid fa-bars"></i>

</button>

<div class="welcome">

<h2 id="greeting">

Good Morning,
<?= htmlspecialchars($_SESSION['username']) ?> 👋

</h2>

<p>

Manage your finances with confidence.

</p>

</div>

</header>

<section class="wallet-banner">

    <div class="wallet-left">

        <p class="wallet-title">
            Available Balance
        </p>

        <div class="wallet-balance-row">

            <h1 id="walletBalance">
                ₦<?= number_format($balance,2) ?>
            </h1>

            <span id="toggleBalance" class="balance-eye">
                <i class="fa-solid fa-eye"></i>
            </span>

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

        <i class="fa-solid fa-wallet wallet-big-icon"></i>

    </div>
    
</section>

<section class="quick-services">

<div class="section-header">

<h3>

Quick Services

</h3>

</div>

<div class="service-grid">

<a href="wallet.php">

<i class="fa-solid fa-wallet"></i>

<p>Wallet</p>

</a>

<a href="fund-wallet.php">

<i class="fa-solid fa-money-bill-wave"></i>

<p>Fund Wallet</p>

</a>

<a href="transfer.php">

<i class="fa-solid fa-money-bill-transfer"></i>

<p>Transfer</p>

</a>

<a href="airtime.php">

<i class="fa-solid fa-mobile-screen-button"></i>

<p>Airtime</p>

</a>

<a href="data.php">

<i class="fa-solid fa-wifi"></i>

<p>Data</p>

</a>

<a href="cable.php">

<i class="fa-solid fa-tv"></i>

<p>Cable TV</p>

</a>

<a href="electricity.php">

<i class="fa-solid fa-bolt"></i>

<p>Electricity</p>

</a>

<a href="transactions.php">

<i class="fa-solid fa-clock-rotate-left"></i>

<p>Transactions</p>

</a>

</div>

</section>

<section class="analytics">

<div class="section-header">

<h3>Wallet Analytics</h3>

<a href="#">Monthly Report</a>

</div>

<div class="analytics-card">

<div class="chart-placeholder">

<i class="fa-solid fa-chart-line"></i>

<h4>Analytics Coming Soon</h4>

<p>Your wallet activity chart will appear here.</p>

</div>

</div>

</section>

<section class="recent-transactions">

<div class="section-header">

<h3>Recent Transactions</h3>

<a href="transactions.php">View All</a>

</div>

<div class="transaction-list">

<div class="transaction-item">

<div class="transaction-info">

<div class="transaction-icon success">

<i class="fa-solid fa-money-bill-wave"></i>

</div>

<div>

<h4>Wallet Funding</h4>

<small>No transaction yet</small>

</div>

</div>

<span class="credit">+ ₦0.00</span>

</div>

<div class="transaction-item">

<div class="transaction-info">

<div class="transaction-icon danger">

<i class="fa-solid fa-paper-plane"></i>

</div>

<div>

<h4>Transfer</h4>

<small>No transaction yet</small>

</div>

</div>

<span class="debit">₦0.00</span>

</div>

<div class="transaction-item">

<div class="transaction-info">

<div class="transaction-icon primary">

<i class="fa-solid fa-mobile-screen-button"></i>

</div>

<div>

<h4>Airtime Purchase</h4>

<small>No transaction yet</small>

</div>

</div>

<span class="debit">₦0.00</span>

</div>

</div>

</section>

</div>

</div>

<script src="/assets/js/dashboard.js"></script>

</body>

</html>
