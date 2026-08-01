<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FinCore Airtime</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/airtime.css">

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
<h1>Airtime Purchase</h1>
<p>Recharge any mobile network instantly.</p>
</div>

<div class="notify">
<i class="fa-solid fa-bell"></i>
</div>

</header>

<section class="airtime-section">

<div class="airtime-card">

<h2>Buy Airtime</h2>

<div class="wallet-balance">

Available Balance

<h3>₦<?= number_format($balance,2) ?></h3>

</div>

<form action="confirm-airtime.php" method="POST">

<label>Select Network</label>

<select name="network" required>

<option value="">Choose Network</option>

<option value="MTN">MTN</option>

<option value="Airtel">Airtel</option>

<option value="Glo">Glo</option>

<option value="9mobile">9mobile</option>

</select>

<label>Phone Number</label>

<input
type="tel"
name="phone"
maxlength="11"
placeholder="08012345678"
required>

<label>Amount</label>

<input
type="number"
id="amount"
name="amount"
placeholder="Enter Amount"
required>

<div class="quick-amounts">

<button type="button" onclick="setAmount(100)">₦100</button>

<button type="button" onclick="setAmount(200)">₦200</button>

<button type="button" onclick="setAmount(500)">₦500</button>

<button type="button" onclick="setAmount(1000)">₦1000</button>

</div>

<button
type="submit"
class="continue-btn">

Continue

</button>

</form>

</div>

</section>

</main>

</div>

<script>

function setAmount(value){

document.getElementById("amount").value=value;

}

</script>

<script src="/assets/js/dashboard.js"></script>

</body>
</html>
