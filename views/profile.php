<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FinCore Profile</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/profile.css">

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
<h1>My Profile</h1>
<p>Manage your account information and security.</p>
</div>

</header>

<section class="profile-section">

<div class="profile-card">

<h2>Personal Information</h2>

<div class="profile-item">
<span>Full Name</span>
<strong><?= htmlspecialchars($user['full_name']) ?></strong>
</div>

<div class="profile-item">
<span>Username</span>
<strong><?= htmlspecialchars($user['username']) ?></strong>
</div>

<div class="profile-item">
<span>Email</span>
<strong><?= htmlspecialchars($user['email']) ?></strong>
</div>

<div class="profile-item">
<span>Phone Number</span>
<strong><?= htmlspecialchars($user['phone']) ?></strong>
</div>

<div class="profile-item">
<span>Member Since</span>
<strong><?= date("d M Y", strtotime($user['created_at'])) ?></strong>
</div>

<div class="profile-item">
<span>Account Status</span>
<strong class="active-status">Active</strong>
</div>

</div>

<div class="profile-card">

<h2>Security</h2>

<a href="change-password.php" class="profile-link">
<i class="fa-solid fa-lock"></i>
Change Password
</a>

<?php if(empty($user['transaction_pin'])): ?>

<a href="set-transaction-pin.php" class="profile-link">
<i class="fa-solid fa-key"></i>
Create Transaction PIN
</a>

<?php else: ?>

<a href="change-transaction-pin.php" class="profile-link">
<i class="fa-solid fa-key"></i>
Change Transaction PIN
</a>

<?php endif; ?>

</div>

<div class="profile-card">

<h2>Account</h2>

<a href="logout.php" class="logout-btn">
<i class="fa-solid fa-right-from-bracket"></i>
Logout
</a>

</div>

</section>

</main>

</div>

<script src="/assets/js/dashboard.js"></script>

</body>
  </html>
