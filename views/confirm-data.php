<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FinCore Data Purchase</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/confirm-data.css">

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

<a href="dashboard.php">
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

<a href="data.php" class="active">
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
<h1>Confirm Data Purchase</h1>
<p>Please review your transaction before proceeding.</p>
</div>

<div class="notify">
<i class="fa-solid fa-bell"></i>
</div>

</header>

<section class="confirm-section">

<div class="confirm-card">

<h2>Transaction Summary</h2>

<div class="summary-item">
<span>Network</span>
<strong><?= htmlspecialchars($_SESSION['data_network']) ?></strong>
</div>

<div class="summary-item">
<span>Data Type</span>
<strong><?= htmlspecialchars($_SESSION['data_type']) ?></strong>
</div>

<div class="summary-item">
<span>Data Plan</span>
<strong><?= htmlspecialchars($_SESSION['data_plan']) ?></strong>
</div>

<div class="summary-item">
<span>Phone Number</span>
<strong><?= htmlspecialchars($_SESSION['data_phone']) ?></strong>
</div>

<div class="summary-item">
<span>Amount</span>
<strong>₦<?= number_format($_SESSION['data_amount'],2) ?></strong>
</div>
  
<div class="summary-item">
<span>Wallet Balance</span>
<strong>₦<?= number_format($balance,2) ?></strong>
</div>

<form action="data-pin.php" method="GET">

<button
type="submit"
class="continue-btn">

Proceed

</button>

</form>

</div>

</section>

</main>

</div>

<script src="/assets/js/dashboard.js"></script>

</body>
</html>
