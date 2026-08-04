<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Wallet Transfer</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/transfer.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="dashboard">

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

<a href="transfer.php" class="active">
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

<h1>Wallet Transfer</h1>

<p>Transfer funds to another FinCore user.</p>

</div>

</header>

<section class="transfer-section">

<div class="transfer-card">

<h2>Transfer Money</h2>

<div class="wallet-balance">

<p>Available Balance</p>

<h3>₦<?= number_format($balance,2) ?></h3>

</div>

<form
action="confirm-transfer.php"
method="POST"
id="transferForm">

<label>

Recipient Username / Email

</label>

<input
type="text"
name="recipient"
id="recipient"
autocomplete="off"
placeholder="Enter username or email"
required>

<input
type="hidden"
name="recipient_id"
id="recipient_id">

<div
id="recipientResult"
class="recipient-result">

</div>

<label>

Amount

</label>

<input
type="number"
name="amount"
min="100"
placeholder="Enter amount"
required>

<label>

Narration (Optional)

</label>

<input
type="text"
name="narration"
placeholder="Enter narration">

<button
class="continue-btn"
type="submit">

Continue

</button>

</form>

</div>

</section>

</main>

</div>

<script src="/assets/js/dashboard.js"></script>

<script>

const recipient=document.getElementById("recipient");
const recipientId=document.getElementById("recipient_id");
const recipientResult=document.getElementById("recipientResult");

let timer=null;

recipient.addEventListener("keyup",function(){

clearTimeout(timer);

recipientId.value="";

recipientResult.style.display="none";

if(this.value.trim().length<3){
return;
}

timer=setTimeout(function(){

fetch("verify-recipient.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:"recipient="+encodeURIComponent(recipient.value.trim())

})

.then(response=>response.json())

.then(data=>{

if(data.success){

recipientResult.style.display="block";

recipientResult.className="success";

recipientResult.innerHTML=
"<i class='fa-solid fa-circle-check'></i> "+
data.full_name;

recipientId.value=data.id;

}else{

recipientResult.style.display="block";

recipientResult.className="error";

recipientResult.innerHTML=
"<i class='fa-solid fa-circle-xmark'></i> "+
data.message;

recipientId.value="";

}

})

.catch(error=>{

console.log(error);

recipientResult.style.display="block";

recipientResult.className="error";

recipientResult.innerHTML=
"Unable to verify recipient.";

});

},500);

});

document
.getElementById("transferForm")
.addEventListener("submit",function(e){

if(recipientId.value===""){

e.preventDefault();

alert("Please enter a valid recipient.");

}

});

</script>

</body>
</html>
