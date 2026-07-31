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

<title>

Dashboard | FinCore

</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="dashboard">

<!-- SIDEBAR -->

<aside class="sidebar" id="sidebar">

<div class="logo-box">

<img
src="/assets/images/logo.png"
class="logo">

<h2>

FinCore

</h2>

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

<div class="main-content">

<header class="topbar">

<button id="menuToggle" class="menu-btn">

<i class="fa-solid fa-bars"></i>

</button>

<div class="top-text">

<h2>

Good Morning,

<?= htmlspecialchars($_SESSION['username']) ?>

👋

</h2>

<p>

Welcome back to FinCore. Manage your finances with confidence.

</p>

</div>

</header>

<section class="wallet-banner">

<div class="wallet-info">

<p class="wallet-title">

Available Balance

</p>

<div class="balance-box">

<h1 id="walletBalance">

₦<?= number_format($balance, 2) ?>

</h1>

<i
class="fa-solid fa-eye"
id="toggleBalance">

</i>

</div>

<div class="wallet-actions">

<a
href="fund-wallet.php"
class="primary-btn">

Fund Wallet

</a>

<a
href="transfer.php"
class="secondary-btn">

Transfer

</a>

</div>

</div>

<div class="wallet-icon">

<i class="fa-solid fa-wallet"></i>

</div>

</section>

<section class="services">

<h3>

Quick Services

</h3>

<div class="service-grid">

<a href="wallet.php" class="service-card">

<i class="fa-solid fa-wallet"></i>

<span>Wallet</span>

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

<a href="transfer.php" class="service-card">

<i class="fa-solid fa-money-bill-transfer"></i>

<span>Transfer</span>

</a>

<a href="transactions.php" class="service-card">

<i class="fa-solid fa-clock-rotate-left"></i>

<span>Transactions</span>

</a>

<a href="profile.php" class="service-card">

<i class="fa-solid fa-user"></i>

<span>Profile</span>

</a>

</div>

    </section>

<section class="analytics">

<h3>

Wallet Analytics

</h3>

<div class="chart-card">

<div class="chart-placeholder">

📈 Monthly Wallet Analytics Chart

<br><br>

<small>

(We'll connect a real chart later.)

</small>

</div>

</div>

</section>

<section class="recent-transactions">

<div class="section-header">

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

Today • 10:35 AM

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

No transfer yet

</small>

</div>

<span class="debit">

₦0.00

</span>

</div>

<div class="transaction-item">

<div>

<h4>

Airtime

</h4>

<small>

No airtime purchase yet

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

<script>

const menuBtn = document.getElementById("menuToggle");

const sidebar = document.getElementById("sidebar");

menuBtn.addEventListener("click", () => {

sidebar.classList.toggle("show");

});

const balance = document.getElementById("walletBalance");

const eye = document.getElementById("toggleBalance");

let hidden = false;

const actualBalance = balance.innerText;

eye.addEventListener("click", () => {

if(hidden){

balance.innerText = actualBalance;

eye.classList.remove("fa-eye-slash");

eye.classList.add("fa-eye");

}else{

balance.innerText = "********";

eye.classList.remove("fa-eye");

eye.classList.add("fa-eye-slash");

}

hidden = !hidden;

});

<script src="/assets/js/dashboard.js"></script>

</body>

    </html>
