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

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

FinCore Dashboard

</title>

<link
rel="stylesheet"
href="/assets/css/dashboard.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="dashboard">

<!-- SIDEBAR -->

<div
class="sidebar"
id="sidebar">

<div class="logo-area">

<img
src="/assets/images/logo.png"
class="logo">

<h2>

FinCore

</h2>

</div>

<div class="menu">

<a
href="dashboard.php"
class="active">

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

</div>

</div>

<!-- CONTENT -->

<div class="content">

<header class="topbar">

<button class="menu-btn" id="menuBtn">

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

<section class="wallet-card">

<div class="wallet-left">

<p>

Available Balance

</p>

<div class="balance">

<h1 id="walletBalance">

₦<?= number_format($balance,2) ?>

</h1>

<i
class="fa-solid fa-eye"
id="toggleBalance">

</i>

</div>

<div class="wallet-buttons">

<a
href="fund-wallet.php"
class="btn-primary">

Fund Wallet

</a>

<a
href="transfer.php"
class="btn-secondary">

Transfer

</a>

</div>

</div>

<div class="wallet-right">

<i class="fa-solid fa-wallet"></i>

</div>

</section>

<section class="services">

<div class="section-title">

<h3>

Quick Services

</h3>

</div>

<div class="service-grid">

<a href="wallet.php">

<i class="fa-solid fa-wallet"></i>

<span>Wallet</span>

</a>

<a href="airtime.php">

<i class="fa-solid fa-mobile-screen"></i>

<span>Airtime</span>

</a>

<a href="data.php">

<i class="fa-solid fa-wifi"></i>

<span>Data</span>

</a>

<a href="cable.php">

<i class="fa-solid fa-tv"></i>

<span>Cable TV</span>

</a>

<a href="electricity.php">

<i class="fa-solid fa-bolt"></i>

<span>Electricity</span>

</a>

<a href="transfer.php">

<i class="fa-solid fa-money-bill-transfer"></i>

<span>Transfer</span>

</a>

<a href="transactions.php">

<i class="fa-solid fa-clock-rotate-left"></i>

<span>Transactions</span>

</a>

<a href="profile.php">

<i class="fa-solid fa-user"></i>

<span>Profile</span>

</a>

</div>

    </section>

<section class="analytics">

<div class="section-title">

<h3>

Wallet Analytics

</h3>

</div>

<div class="chart-card">

<div class="chart-placeholder">

📈 Wallet Activity Chart

<br><br>

<small>

Your wallet statistics will appear here.

</small>

</div>

</div>

</section>

<section class="recent-transactions">

<div class="section-title">

<h3>

Recent Transactions

</h3>

<a href="transactions.php">

View All

</a>

</div>

<div class="transaction-list">

<div class="transaction-item">

<div>

<h4>

Wallet Funding

</h4>

<small>

No transaction yet

</small>

</div>

<span class="credit">

+ ₦0.00

</span>

</div>

<div class="transaction-item">

<div>

<h4>

Transfer

</h4>

<small>

No transaction yet

</small>

</div>

<span class="debit">

₦0.00

</span>

</div>

<div class="transaction-item">

<div>

<h4>

Airtime Purchase

</h4>

<small>

No transaction yet

</small>

</div>

<span class="debit">

₦0.00

</span>

</div>

</div>

</section>

</div>

</div>

<script src="/assets/js/dashboard.js"></script>

</body>

</html>
