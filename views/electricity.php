<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FinCore Electricity</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/electricity.css">

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

<main class="content">

<header class="top-header">

<button id="menuBtn" class="menu-btn">
<i class="fa-solid fa-bars"></i>
</button>

<div class="welcome">
<h1>Electricity Bills</h1>
<p>Pay your electricity bills instantly.</p>
</div>

</header>

<section class="electricity-section">

<div class="electricity-card">

<h2>Electricity Payment</h2>

<div class="wallet-balance">
<p>Wallet Balance</p>
<h3>₦<?= number_format($balance,2) ?></h3>
</div>

<form action="confirm-electricity.php" method="POST">

<label>Distribution Company</label>

<select name="distribution_company" required>
  
<option value="">Choose Distribution Company</option>

<option value="IKEDC">Ikeja Electric</option>

<option value="EKEDC">Eko Electric</option>

<option value="AEDC">Abuja Electric</option>

<option value="KEDCO">Kano Electric</option>

<option value="EEDC">Enugu Electric</option>

<option value="PHED">Port Harcourt Electric</option>

<option value="IBEDC">Ibadan Electric</option>

<option value="KAEDCO">Kaduna Electric</option>

<option value="JED">Jos Electric</option>

<option value="BEDC">Benin Electric</option>

<option value="YEDC">Yola Electric</option>

<option value="APLE">Aba Electric</option>
</select>

<label>Meter Type</label>

<select name="meter_type" required>

<option value="">Choose Meter Type</option>

<option value="Prepaid">Prepaid</option>

<option value="Postpaid">Postpaid</option>

</select>

<label>Meter Number</label>

<input
type="number"
name="meter_number"
placeholder="Enter Meter Number"
required>

<button
type="button"
class="verify-btn">

Verify Meter

</button>

<label>Amount</label>

<input
type="number"
name="amount"
placeholder="Enter Amount"
min="100"
required>

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

<script src="/assets/js/dashboard.js"></script>

<script>

document.querySelector(".verify-btn").addEventListener("click", function(){

const meter =
document.querySelector("input[name='meter_number']").value;

if(meter===""){

alert("Please enter your meter number first.");

return;

}

alert("Meter verification will be activated after VTU API integration.");

});

</script>

</body>
</html>
