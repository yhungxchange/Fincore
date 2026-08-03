<!DOCTYPE html>

<html>

<head>

<title>User Profile</title>

<link rel="stylesheet"
href="/assets/css/dashboard.css">

<link rel="stylesheet"
href="/assets/css/admin.css">

</head>

<body>

<div class="dashboard">

<div class="content">

<h1>👤 User Profile</h1>

<br>

<div class="admin-card">

<p><strong>Full Name:</strong> <?= htmlspecialchars($user['full_name']) ?></p>

<br>

<p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>

<br>

<p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

<br>

<p><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?></p>

<br>

<p><strong>Wallet:</strong>

₦<?= number_format($user['balance'],2) ?>

</p>

<br>

<p><strong>Joined:</strong>

<?= date("d M Y",strtotime($user['created_at'])) ?>

</p>

<br>

<p>

<strong>Admin:</strong>

<?= $user['is_admin'] ? "Yes" : "No" ?>

</p>

<br>

<a href="users.php"

class="search-btn">

<br><br>

<a href="credit-wallet.php?id=<?= $user['id'] ?>"
class="search-btn">

💰 Credit Wallet

</a>
  
← Back

</a>

</div>

</div>

</div>

</body>

</html>
