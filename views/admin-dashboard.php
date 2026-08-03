<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width,initial-scale=1">

<title>Admin Dashboard</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">

<link rel="stylesheet" href="/assets/css/admin.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="dashboard">

<div class="content">

<div class="top-header">

<div class="welcome">

<h1>👑 Admin Dashboard</h1>

<p>Welcome back,
<strong><?= htmlspecialchars($user['full_name']) ?></strong>

</p>

</div>

</div>

<div class="admin-grid">

<div class="admin-card">

<i class="fa-solid fa-users"></i>

<h2><?= number_format($totalUsers) ?></h2>

<p>Total Users</p>

</div>

<div class="admin-card">

<i class="fa-solid fa-wallet"></i>

<h2>₦<?= number_format($totalWallet,2) ?></h2>

<p>Total Wallet Balance</p>

</div>

<div class="admin-card">

<i class="fa-solid fa-arrow-right-arrow-left"></i>

<h2><?= number_format($totalTransactions) ?></h2>

<p>Total Transactions</p>

</div>

<div class="admin-card">

<i class="fa-solid fa-bell"></i>

<h2><?= number_format($totalNotifications) ?></h2>

<p>Notifications</p>

</div>

</div>

</div>

</div>

</body>

</html>
