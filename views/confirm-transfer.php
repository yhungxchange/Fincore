<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Confirm Transfer</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/transfer.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="dashboard">

<main class="content">

<header class="top-header">

<h1>Confirm Transfer</h1>

<p>Please confirm the transfer details.</p>

</header>

<section class="transfer-section">

<div class="transfer-card">

<div class="success-icon">
<i class="fa-solid fa-money-bill-transfer"></i>
</div>

<h2>Transfer Summary</h2>

<div class="summary-item">
<span>Recipient</span>
<strong><?= htmlspecialchars($_SESSION['transfer']['recipient_name']) ?></strong>
</div>

<div class="summary-item">
<span>Username</span>
<strong><?= htmlspecialchars($_SESSION['transfer']['recipient_username']) ?></strong>
</div>

<div class="summary-item">
<span>Email</span>
<strong><?= htmlspecialchars($_SESSION['transfer']['recipient_email']) ?></strong>
</div>

<div class="summary-item">
<span>Amount</span>
<strong>₦<?= number_format($_SESSION['transfer']['amount'],2) ?></strong>
</div>

<div class="summary-item">
<span>Narration</span>
<strong>
<?= $_SESSION['transfer']['narration'] ?: 'No Narration'; ?>
</strong>
</div>

<form action="transfer-pin.php" method="POST">

<button
type="submit"
class="continue-btn">

Continue

</button>

</form>

<br>

<a
href="transfer.php"
class="cancel-btn">

Cancel Transfer

</a>

</div>

</section>

</main>

</div>

</body>

</html>
