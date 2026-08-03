<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Notifications</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">

<link rel="stylesheet" href="/assets/css/notifications.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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
  
<div class="main-content">

<div class="top-bar">

<h2>Notifications</h2>

<div class="notification-summary">

</div>

<div class="notification-list">

<?php if(empty($notifications)): ?>

<div class="empty-state">

<i class="fa-regular fa-bell-slash"></i>

<h3>No Notifications</h3>

<p>Your notifications will appear here.</p>

</div>

<?php else: ?>

<?php foreach($notifications as $row): ?>

<div class="notification-card <?= $row['is_read'] ? 'read' : 'unread' ?>">

<div class="notification-icon">

<?php

switch($row['type']){

case 'transfer':

echo '<i class="fa-solid fa-money-bill-transfer"></i>';

break;

case 'wallet':

echo '<i class="fa-solid fa-wallet"></i>';

break;

case 'airtime':

echo '<i class="fa-solid fa-mobile-screen"></i>';

break;

case 'data':

echo '<i class="fa-solid fa-wifi"></i>';

break;

default:

echo '<i class="fa-solid fa-bell"></i>';

}

?>

</div>

<div class="notification-body">

<h3><?= htmlspecialchars($row['title']) ?></h3>

<p><?= htmlspecialchars($row['message']) ?></p>

<span>

<?= date("d M Y h:i A",strtotime($row['created_at'])) ?>

</span>

</div>

</div>

<?php endforeach; ?>

<?php endif; ?>

</div>

</div>

</div>

</body>

</html>
