<?php

$tempPassword = $_SESSION['temp_password'] ?? null;
unset($_SESSION['temp_password']);

?>

<!DOCTYPE html>
<html>

<head>

<title>User Profile</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/admin.css">

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
<?= date("d M Y", strtotime($user['created_at'])) ?>
</p>

<br>

<p>
<strong>Admin:</strong>
<?= $user['is_admin'] ? "Yes" : "No" ?>
</p>

<br>

<div class="action-buttons">

<a href="credit-wallet.php?id=<?= $user['id'] ?>"
class="search-btn"
style="background:#6D4DFF;">
💰 Credit Wallet
</a>

<a href="debit-wallet.php?id=<?= $user['id'] ?>"
class="search-btn"
style="background:#dc3545;">
➖ Debit Wallet
</a>

<?php if($user['is_active']): ?>

<a href="toggle-user.php?id=<?= $user['id'] ?>&action=lock"
class="search-btn"
style="background:#ff9800;">
🔒 Lock User
</a>

<?php else: ?>

<a href="toggle-user.php?id=<?= $user['id'] ?>&action=unlock"
class="search-btn"
style="background:#22c55e;">
🔓 Unlock User
</a>

<?php endif; ?>

<a href="reset-pin.php?id=<?= $user['id'] ?>"
class="search-btn"
style="background:#ff9800;">
🔑 Reset Transaction PIN
</a>

<a href="reset-password.php?id=<?= $user['id'] ?>"
class="search-btn"
style="background:#dc3545;">
🔐 Reset Login Password
</a>

<a href="users.php"
class="search-btn"
style="background:#888;">
← Back
</a>

</div>

</div>

</div>

</div>

<?php if($tempPassword): ?>

<div id="passwordModal" class="password-modal">

<div class="password-box">

<h2>🔐 Temporary Password</h2>

<p>
Give this password to the user.
The user will be forced to change it immediately after logging in.
</p>

<div id="tempPassword" class="password-display">

<?= htmlspecialchars($tempPassword) ?>

</div>

<button class="copy-btn" onclick="copyPassword()">

📋 Copy Password

</button>

<button class="close-btn" onclick="closeModal()">

Close

</button>

</div>

</div>

<script>

function copyPassword(){

const password =
document.getElementById("tempPassword").innerText;

navigator.clipboard.writeText(password);

alert("✅ Temporary password copied successfully.");

}

function closeModal(){

document.getElementById("passwordModal").style.display="none";

}

</script>

<?php endif; ?>

</body>

</html>
