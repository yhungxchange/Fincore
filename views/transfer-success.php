<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Transfer Successful</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/transfer-success.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="success-container">

<div class="success-card">

<div class="success-icon">
<i class="fa-solid fa-circle-check"></i>
</div>

<h2>Transfer Successful</h2>

<div class="amount">
₦<?= number_format($_SESSION['receipt']['amount'],2) ?>
</div>

<p class="subtitle">
Your transfer was completed successfully.
</p>

<div class="receipt">

<div class="receipt-row">
<span>Recipient</span>
<strong><?= htmlspecialchars($_SESSION['receipt']['recipient']) ?></strong>
</div>

<div class="receipt-row">
<span>Narration</span>
<strong><?= htmlspecialchars($_SESSION['receipt']['narration']) ?></strong>
</div>

<div class="receipt-row">
<span>Reference</span>
<strong><?= htmlspecialchars($_SESSION['receipt']['reference']) ?></strong>
</div>

<div class="receipt-row">
<span>Date</span>
<strong><?= date("d M Y • h:i A") ?></strong>
</div>

</div>

<div class="buttons">

<button class="share-btn">
<i class="fa-solid fa-share-nodes"></i>
Share Receipt
</button>

<a href="dashboard.php" class="done-btn">
<i class="fa-solid fa-house"></i>
Done
</a>

</div>

</div>

</div>

</body>
</html>
