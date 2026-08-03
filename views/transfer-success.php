<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Transfer Successful</title>

<link rel="stylesheet" href="/assets/css/transfer-success.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="success-wrapper">

<div class="success-card">

<div class="icon">

<i class="fa-solid fa-circle-check"></i>

</div>

<h1>Transfer Successful</h1>

<p>Your transfer has been completed successfully.</p>

<div class="details">

<div class="item">
<span>Recipient</span>
<strong><?= htmlspecialchars($data['recipient_name']) ?></strong>
</div>

<div class="item">
<span>Amount</span>
<strong>₦<?= number_format($data['amount'],2) ?></strong>
</div>

<div class="item">
<span>Reference</span>
<strong><?= htmlspecialchars($data['reference']) ?></strong>
</div>

<div class="item">
<span>Narration</span>
<strong><?= htmlspecialchars($data['narration']) ?></strong>
</div>

<div class="item">
<span>Date</span>
<strong><?= date("d M Y h:i A") ?></strong>
</div>

</div>

<a href="dashboard.php" class="done-btn">

<i class="fa-solid fa-house"></i>

Done

</a>

</div>

</div>

</body>

</html>
