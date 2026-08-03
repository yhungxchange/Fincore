<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Transfer Successful</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/transfer.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="dashboard">

<main class="content">

<section class="transfer-section">

<div class="transfer-card success-card">

<div class="success-icon">

<i class="fa-solid fa-circle-check"></i>

</div>

<h2>Transfer Successful</h2>

<p class="success-text">

Your transfer has been completed successfully.

</p>

<div class="summary-item">

<span>Recipient</span>

<strong>

<?= htmlspecialchars($_SESSION['transfer_success']['recipient_name']) ?>

</strong>

</div>

<div class="summary-item">

<span>Amount</span>

<strong>

₦<?= number_format($_SESSION['transfer_success']['amount'],2) ?>

</strong>

</div>

<div class="summary-item">

<span>Reference</span>

<strong>

<?= $_SESSION['transfer_success']['reference'] ?>

</strong>

</div>

<div class="summary-item">

<span>Narration</span>

<strong>

<?= htmlspecialchars($_SESSION['transfer_success']['narration']) ?: "None" ?>

</strong>

</div>

<div class="summary-item">

<span>Date</span>

<strong>

<?= date("d M Y h:i A") ?>

</strong>

</div>

<br>

<a href="dashboard.php" class="continue-btn">

<i class="fa-solid fa-house"></i>

Done

</a>

</div>

</section>

</main>

</div>

</body>

</html>

<?php
unset($_SESSION['transfer_success']);
?>
