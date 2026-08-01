<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FinCore Password</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/transactions.css">

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
<h1>Recent Transactions</h1>
<p>View all your account activities.</p>
</div>

<div class="notify">
<i class="fa-solid fa-bell"></i>
</div>

</header>

<section class="transaction-section">

<div class="filter-buttons">

<a href="?type=all" class="<?= $filter=='all'?'active':'' ?>">All</a>

<a href="?type=funding" class="<?= $filter=='funding'?'active':'' ?>">Funding</a>

<a href="?type=airtime" class="<?= $filter=='airtime'?'active':'' ?>">Airtime</a>

<a href="?type=data" class="<?= $filter=='data'?'active':'' ?>">Data</a>

<a href="?type=cable" class="<?= $filter=='cable'?'active':'' ?>">Cable TV</a>

<a href="?type=electricity" class="<?= $filter=='electricity'?'active':'' ?>">Electricity</a>

<a href="?type=transfer" class="<?= $filter=='transfer'?'active':'' ?>">Transfer</a>

</div>

<div class="table-card">

<h2>Recent Transactions</h2>

<div class="table-responsive">

<table>

<thead>

<tr>

<th>Transaction</th>

<th>Amount</th>

<th>Status</th>

<th>Reference</th>

<th>Date</th>

</tr>

</thead>

<tbody>

<?php if(!empty($transactions)): ?>

<?php foreach($transactions as $row): ?>

<tr>

<td><?= htmlspecialchars($row['description']) ?></td>

<td>₦<?= number_format($row['amount'],2) ?></td>

<td>

<span class="status <?= strtolower($row['status']) ?>">

<?= ucfirst($row['status']) ?>

</span>

</td>

<td><?= htmlspecialchars($row['reference']) ?></td>

<td><?= date("d M Y h:i A",strtotime($row['created_at'])) ?></td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="5" class="empty">

No Transactions Found.

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</section>

</main>

</div>

<script src="/assets/js/dashboard.js"></script>

</body>
</html>
