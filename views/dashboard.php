<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinCore Dashboard</title>

    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>

<div class="sidebar">

    <div class="logo">
        <h2>FinCore</h2>
    </div>

    <ul>

        <li><a href="#">🏠 Dashboard</a></li>

        <li><a href="#">💰 Deposit</a></li>

        <li><a href="#">💸 Transfer</a></li>

        <li><a href="#">📜 Transactions</a></li>

        <li><a href="#">📱 Airtime</a></li>

        <li><a href="#">🌐 Data</a></li>

        <li><a href="#">📺 Cable TV</a></li>

        <li><a href="#">⚡ Electricity</a></li>

        <li><a href="#">👤 Profile</a></li>

        <li><a href="logout.php">🚪 Logout</a></li>

    </ul>

</div>


<div class="main-content">

    <div class="topbar">

        <div class="menu-btn">
            ☰
        </div>

        <div class="welcome">

            <h2>
                Welcome back,
                <?= htmlspecialchars($_SESSION['username']) ?>
                👋
            </h2>

        </div>

    </div>


    <div class="wallet-card">

        <h3>Wallet Balance</h3>

        <h1>
            ₦<?= number_format($balance,2) ?>
        </h1>

    </div>


    <div class="quick-actions">

        <div class="action-card">
            💰
            <p>Deposit</p>
        </div>

        <div class="action-card">
            💸
            <p>Transfer</p>
        </div>

        <div class="action-card">
            📱
            <p>Airtime</p>
        </div>

        <div class="action-card">
            🌐
            <p>Data</p>
        </div>

        <div class="action-card">
            📺
            <p>Cable</p>
        </div>

        <div class="action-card">
            ⚡
            <p>Electricity</p>
        </div>

    </div>


    <div class="transactions">

        <h3>Recent Transactions</h3>

        <p>No transactions available.</p>

    </div>

</div>

<script src="../assets/js/dashboard.js"></script>

</body>
</html>
