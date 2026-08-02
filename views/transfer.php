<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FinCore Transfer</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/transfer.css">

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
<p>Transfer money to another FinCore user.</p>
</div>

<div class="notify">
<i class="fa-solid fa-bell"></i>
</div>

</header>

<section class="transfer-section">

<div class="transfer-card">

<h2>Transfer Funds</h2>

<div class="wallet-balance">
<p>Wallet Balance</p>
<h3>₦<?= number_format($balance,2) ?></h3>
</div>

<?php if(isset($_SESSION['error'])): ?>

<div class="alert error">
<?= $_SESSION['error']; unset($_SESSION['error']); ?>
</div>

<?php endif; ?>

<form action="confirm-transfer.php" method="POST">

<label>Recipient Username or Email</label>

<input
type="text"
name="recipient"
id="recipient"
placeholder="Enter Username or Email"
required>

<input
type="hidden"
name="recipient_id"
id="recipient_id">

<button
type="button"
class="verify-btn">

Verify Recipient

</button>

<div id="recipientResult"></div>

<label>Amount</label>

<input
type="number"
name="amount"
min="100"
placeholder="Enter Amount"
required>

<label>Narration (Optional)</label>

<input
type="text"
name="narration"
placeholder="Enter Narration">

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

const verifyBtn = document.querySelector(".verify-btn");

verifyBtn.addEventListener("click", function(){

const recipient =
document.getElementById("recipient").value.trim();

const result =
document.getElementById("recipientResult");

const recipientId =
document.getElementById("recipient_id");

if(recipient===""){

result.className="error";

result.style.display="block";

result.innerHTML="Please enter recipient username or email.";

recipientId.value="";

return;

}

fetch("verify-recipient.php",{
    method:"POST",
    headers:{
        "Content-Type":"application/x-www-form-urlencoded"
    },
    body:"recipient="+encodeURIComponent(recipient)
})
.then(response=>response.text())
.then(data=>{

    console.log(data);

    alert(data);

});

.then(response=>response.json())

.then(data=>{

if(data.success){

result.className="success";

result.style.display="block";

result.innerHTML=
"<i class='fa-solid fa-circle-check'></i> "
+data.fullname;

recipientId.value=data.id;

}else{

result.className="error";

result.style.display="block";

result.innerHTML=
"<i class='fa-solid fa-circle-xmark'></i> "
+data.message;

recipientId.value="";

}

})

.catch(()=>{

result.className="error";

result.style.display="block";

result.innerHTML="Network Error. Try again.";

recipientId.value="";

});

});

document.querySelector("form").addEventListener("submit",function(e){

if(document.getElementById("recipient_id").value===""){

e.preventDefault();

alert("Please verify recipient before continuing.");

}

});

</script>

</body>
</html>
