<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FinCore Wallet Funding</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/fund-wallet.css">

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

<!-- MAIN CONTENT -->

<main class="content">

<header class="top-header">

<button id="menuBtn" class="menu-btn">
    <i class="fa-solid fa-bars"></i>
</button>

<div class="welcome">
    <h1>Fund Wallet</h1>
    <p>Choose your preferred funding method.</p>
</div>

</header>

<!-- FUND METHODS -->

<section class="fund-methods">

<h2>Select Funding Method</h2>

<div class="method-grid">

<div class="method-card"
onclick="location.href='manual-funding.php'">

<div class="method-icon">
<i class="fa-solid fa-money-bill-wave"></i>
</div>

<h3>Manual Funding</h3>

<p>Instant wallet funding.</p>

</div>

<div class="method-card disabled">

<div class="method-icon">
<i class="fa-solid fa-building-columns"></i>
</div>

<h3>Monnify Funding</h3>

<p>Coming Soon 🚧</p>

</div>

</div>

</section>

</main>

</div>

<script src="/assets/js/dashboard.js"></script>

</body>

  </html>
