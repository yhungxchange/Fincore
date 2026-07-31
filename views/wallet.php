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

<title>FinCore Wallet</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/wallet.css">

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
    <h1>Wallet</h1>
    <p>Manage your wallet and transactions.</p>
</div>

<div class="notify">
    <i class="fa-solid fa-bell"></i>
</div>

</header>


<!-- WALLET STATISTICS -->

<section class="wallet-statistics">

<h2>Wallet Statistics</h2>

<div class="stats-grid">

<div class="stat-card">
<h4>Wallet Balance</h4>
<h2>₦<?= number_format($balance,2) ?></h2>
</div>

<div class="stat-card">
<h4>Total Funding</h4>
<h2>₦<?= number_format($totalFunding ?? 0,2) ?></h2>
</div>

<div class="stat-card">
<h4>Total Spent</h4>
<h2>₦<?= number_format($totalSpent ?? 0,2) ?></h2>
</div>

</div>

</section>



<!-- WALLET SUMMARY -->

<section class="wallet-summary">

<div class="summary-header">

<h2>Wallet Summary</h2>

<div class="summary-actions">

<input type="text"
placeholder="Search transaction...">

<button class="search-btn">
<i class="fa fa-search"></i>
Search
</button>

<button class="refresh-btn"
onclick="location.reload()">

<i class="fa fa-rotate-right"></i>

Refresh

</button>

</div>

</div>



<div class="table-responsive">

<table>

<thead>

<tr>

<th>Transaction</th>

<th>Amount Paid</th>

<th>Balance Before</th>

<th>Balance After</th>

<th>Date</th>

</tr>

</thead>

<tbody>

<?php if(!empty($transactions)): ?>

<?php foreach($transactions as $row): ?>

<tr>

<td><?= htmlspecialchars($row['description']) ?></td>

<td>₦<?= number_format($row['amount'],2) ?></td>

<td>₦<?= number_format($row['balance_before'],2) ?></td>

<td>₦<?= number_format($row['balance_after'],2) ?></td>

<td><?= date("M d, Y h:i A",strtotime($row['created_at'])) ?></td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="5" style="text-align:center;padding:30px;">

No transaction found.

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>



<div class="pagination">

<button disabled>Previous</button>

<button class="active">1</button>

<button>Next</button>

</div>

</section>

</main>

</div>

<script src="/assets/js/dashboard.js"></script>

</body>

</html>
