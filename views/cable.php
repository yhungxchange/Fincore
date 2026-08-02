<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FinCore Airtime</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/cable.css">

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
<h1>Cable TV</h1>
<p>Subscribe your Cable TV easily.</p>
</div>

<div class="notify">
<i class="fa-solid fa-bell"></i>
</div>

</header>

<section class="cable-section">

<div class="cable-card">

<h2>Cable Subscription</h2>

<div class="wallet-balance">
<p>Wallet Balance</p>
<h3>₦<?= number_format($balance,2) ?></h3>
</div>

<form action="confirm-cable.php" method="POST">

<label>Provider</label>

<select
id="provider"
name="provider"
required>

<option value="">Choose Provider</option>

<option value="DSTV">DSTV</option>

<option value="GOTV">GOTV</option>

<option value="Startimes">Startimes</option>

</select>

<label>Smartcard Number</label>

<input
type="number"
name="smartcard"
placeholder="Enter Smartcard Number"
required>

<button
type="button"
class="verify-btn">

Verify Customer

</button>

<label>Bouquet</label>

<select
id="bouquet"
name="bouquet"
required>

<option value="">Choose Bouquet</option>

</select>

<button
type="submit"
class="continue-btn">

Continue

</button>

</form>

</div>

</section>

<script src="/assets/js/dashboard.js"></script>

<script>

const bouquets = {

DSTV:[
["Padi",4400],
["Yanga",6000],
["Confam",11000],
["Compact",19000],
["Compact Plus",30000],
["Premium",44000]
],

GOTV:[
["Smallie",3900],
["Jinja",5800],
["Jolli",8100],
["Max",12000],
["Supa",17000],
["Supa Plus",24500]
],

Startimes:[
["Nova",2500],
["Basic",4200],
["Classic",6200],
["Super",9800]
]

};

const provider = document.getElementById("provider");
const bouquet = document.getElementById("bouquet");

provider.addEventListener("change", function(){

bouquet.innerHTML =
'<option value="">Choose Bouquet</option>';

if(!bouquets[this.value]) return;

bouquets[this.value].forEach(item=>{

bouquet.innerHTML += `
<option value="${item[0]}|${item[1]}">
${item[0]} - ₦${item[1]}
</option>
`;

});

});

document.querySelector(".verify-btn").addEventListener("click", function(){

const smartcard =
document.querySelector("input[name='smartcard']").value;

if(smartcard===""){

alert("Enter Smartcard Number first.");

return;

}

alert("Customer verification will be activated immediately after VTU API integration.");

});

</script>

</body>
</html>
