<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FinCore Analytics</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/analytics.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="dashboard">

<main class="content">

<header class="top-header">

<div class="welcome">

<h1>Wallet Analytics</h1>

<p>Track your income and spending.</p>

</div>

</header>

<section class="analytics-summary">

<div class="summary-card income">

<i class="fa-solid fa-arrow-down"></i>

<h4>Money In</h4>

<h2>₦<?= number_format($moneyIn,2) ?></h2>

</div>

<div class="summary-card expense">

<i class="fa-solid fa-arrow-up"></i>

<h4>Money Out</h4>

<h2>₦<?= number_format($moneyOut,2) ?></h2>

</div>

<div class="summary-card net">

<i class="fa-solid fa-wallet"></i>

<h4>Net Cash Flow</h4>

<h2>
₦<?= number_format($netFlow,2) ?>
</h2>

</div>

</section>

</main>

</div>

</body>

</html>
