<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Wallet Analytics</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/analytics.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

<a href="analytics.php" class="active">
<i class="fa-solid fa-chart-pie"></i>
Analytics
</a>

<a href="logout.php">
<i class="fa-solid fa-right-from-bracket"></i>
Logout
</a>

</nav>

</aside>

<!-- MAIN -->

<main class="content">

<header class="top-header">

<button id="menuBtn" class="menu-btn">

<i class="fa-solid fa-bars"></i>

</button>

<div class="welcome">

<h1>Wallet Analytics</h1>

<p>Income vs Spending Overview</p>

</div>

</header>

<!-- EVERYTHING ELSE WILL ENTER HERE -->

<div class="analytics-top">

    <!-- LEFT -->

    <div class="analytics-card chart-card">

        <h2>Income vs Spending</h2>

        <p>This Month</p>

        <canvas id="donutChart"></canvas>

    </div>

    <!-- RIGHT -->

    <div class="analytics-card summary-card">

        <!-- Money In -->

        <div class="summary-item">

            <div class="summary-left">

                <span class="badge income"></span>

                <div>

                    <h3>Money In</h3>

                    <small>Funding + Incoming Transfers</small>

                </div>

            </div>

            <h2 class="income-text">

                ₦<?= number_format($moneyIn,2) ?>

            </h2>

        </div>

        <hr>

        <!-- Money Out -->

        <div class="summary-item">

            <div class="summary-left">

                <span class="badge expense"></span>

                <div>

                    <h3>Money Out</h3>

                    <small>Airtime, Data, Bills & Transfers</small>

                </div>

            </div>

            <h2 class="expense-text">

                ₦<?= number_format($moneyOut,2) ?>

            </h2>

        </div>

        <hr>

        <!-- Cash Flow -->

        <div class="cash-flow">

            <h3>Net Cash Flow</h3>

            <h1 class="<?= $cashFlow >= 0 ? 'income-text' : 'expense-text' ?>">

                <?= $cashFlow >= 0 ? '+' : '-' ?>

                ₦<?= number_format(abs($cashFlow),2) ?>

            </h1>

            <p>

                <?= $cashFlow >= 0
                    ? "You received more than you spent."
                    : "You spent more than you received."
                ?>

            </p>

        </div>

    </div>

</div>
  
</main>

</div>

<script src="/assets/js/dashboard.js"></script>

</body>

</html>
