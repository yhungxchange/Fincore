<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FinCore Data Purchase</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/data.css">

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

<a href="dashboard.php">
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

<a href="data.php" class="active">
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

<h1>Data Purchase</h1>

<p>Purchase affordable data bundles instantly.</p>

</div>

<div class="notify">

<i class="fa-solid fa-bell"></i>

</div>

</header>

<section class="data-section">

<div class="data-card">

<h2>Buy Data Bundle</h2>

<div class="wallet-balance">

<p>Available Balance</p>

<h3>₦<?= number_format($balance,2) ?></h3>

</div>

<form action="confirm-data.php" method="POST">

<label>Select Network</label>

<select id="network" name="network" required>

<option value="">Choose Network</option>

<option value="MTN">MTN</option>

<option value="Airtel">Airtel</option>

<option value="Glo">Glo</option>

<option value="9mobile">9mobile</option>

</select>

<label>Select Data Type</label>

<select id="dataType" name="data_type" required>

<option value="">Choose Data Type</option>

</select>

<label>Select Data Plan</label>

<select id="dataPlan" name="plan" required>

<option value="">Choose Data Plan</option>

</select>

<label>Phone Number</label>

<input
type="tel"
name="phone"
maxlength="11"
placeholder="08012345678"
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

const dataPlans = {

MTN:{
"SME":[
["500MB",180],["1GB",350],["1.2GB",420],["1.5GB",500],
["2GB",650],["2.5GB",800],["3GB",950],["3.5GB",1100],
["5GB",1600],["7GB",2200],["10GB",3200],
["12GB",3800],["15GB",4700],["18GB",5600],["20GB",6200]
],

"Corporate Gifting":[
["500MB",190],["1GB",370],["1.2GB",440],["1.5GB",520],
["2GB",700],["3GB",1020],["5GB",1700],
["10GB",3400],["15GB",5000],["20GB",6800]
],

"Awoof":[
["500MB",170],["1GB",300],["1.5GB",450],
["2GB",600],["3GB",900],["5GB",1500],
["10GB",3000],["15GB",4500],["20GB",6000]
],

"Direct":[
["500MB",220],["1GB",400],["1.2GB",470],["1.5GB",560],
["2GB",750],["3GB",1100],["5GB",1800],
["10GB",3500],["15GB",5200],["20GB",7000]
]
},

Airtel:{
"Awoof":[
["500MB",170],["1GB",300],["1.5GB",450],
["2GB",600],["3GB",900],["5GB",1500],
["10GB",3000],["15GB",4500],["20GB",6000]
],

"SME":[
["500MB",200],["1GB",350],["1.2GB",420],
["1.5GB",500],["2GB",650],["3GB",950],
["5GB",1600],["10GB",3200],
["15GB",4700],["20GB",6300]
],

"Gifting":[
["500MB",230],["1GB",400],["1.5GB",560],
["2GB",750],["3GB",1100],["5GB",1850],
["10GB",3600],["15GB",5300],["20GB",7100]
]
},

Glo:{
"Corporate Gifting":[
["500MB",180],["1GB",350],["1.5GB",500],
["2GB",650],["3GB",950],["5GB",1600],
["10GB",3200],["15GB",4700],["20GB",6300]
],

"SME":[
["500MB",170],["1GB",330],["1.5GB",480],
["2GB",620],["3GB",900],["5GB",1550],
["10GB",3100],["15GB",4550],["20GB",6100]
]
},

"9mobile":{
"Direct":[
["500MB",250],["1GB",450],["1.5GB",620],
["2GB",850],["3GB",1200],["5GB",2100],
["10GB",4100],["15GB",6100],["20GB",8100]
]
}

};

const network = document.getElementById("network");
const dataType = document.getElementById("dataType");
const dataPlan = document.getElementById("dataPlan");

network.addEventListener("change", function(){

dataType.innerHTML='<option value="">Choose Data Type</option>';
dataPlan.innerHTML='<option value="">Choose Data Plan</option>';

if(!dataPlans[this.value]) return;

Object.keys(dataPlans[this.value]).forEach(type=>{

dataType.innerHTML += `<option value="${type}">${type}</option>`;

});

});

dataType.addEventListener("change", function(){

dataPlan.innerHTML='<option value="">Choose Data Plan</option>';

const plans = dataPlans[network.value][this.value];

plans.forEach(plan=>{

dataPlan.innerHTML += `
<option value="${plan[1]}">
${plan[0]} - ₦${plan[1]}
</option>`;

});

});

</script>

</body>
</html>
