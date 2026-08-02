<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Transfer PIN</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/transfer.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="dashboard">

<main class="content">

<header class="top-header">

<h1>Transaction PIN</h1>

<p>Enter your 4-digit transaction PIN.</p>

</header>

<section class="transfer-section">

<div class="transfer-card">

<div class="success-icon">

<i class="fa-solid fa-lock"></i>

</div>

<h2>Confirm With PIN</h2>

<div class="summary-item">
<span>Recipient</span>
<strong><?= htmlspecialchars($_SESSION['transfer']['recipient_name']) ?></strong>
</div>

<div class="summary-item">
<span>Amount</span>
<strong>₦<?= number_format($_SESSION['transfer']['amount'],2) ?></strong>
</div>

<form action="process-transfer.php" method="POST">

<label>Transaction PIN</label>

<input
type="password"
name="pin"
maxlength="4"
inputmode="numeric"
placeholder="****"
required>

<br><br>

<button
type="submit"
class="continue-btn">

<i class="fa-solid fa-paper-plane"></i>

Transfer Now

</button>

</form>

<br>

<a
href="transfer.php"
class="cancel-btn">

Cancel

</a>

</div>

</section>

</main>

</div>

</body>

</html>
