<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinCore Dashboard</title>

    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>

<div class="container">

    <!-- Sidebar -->

    <aside class="sidebar">

        <div class="logo">
            FinCore
        </div>

        <ul>

            <li><a href="#" class="active">🏠 Dashboard</a></li>

            <li><a href="#">👛 Wallet</a></li>

            <li><a href="#">💰 Deposit</a></li>

            <li><a href="#">💸 Transfer</a></li>

            <li><a href="#">📱 Airtime & Data</a></li>

            <li><a href="#">📺 Bills Payment</a></li>

            <li><a href="#">📜 Transactions</a></li>

            <li><a href="#">💳 Cards</a></li>

            <li><a href="#">👤 Beneficiaries</a></li>

            <li><a href="#">⚙ Settings</a></li>

            <li><a href="#">🛟 Support</a></li>

            <li style="margin-top:30px;">
                <a href="logout.php">🚪 Logout</a>
            </li>

        </ul>

    </aside>

    <!-- Main -->

    <main class="main">

        <!-- Top -->

        <div class="topbar">

            <h2>
                Welcome back,
                <?= htmlspecialchars($_SESSION['username']); ?> 👋
            </h2>

        </div>

        <!-- Cards -->

        <div class="grid">

            <div class="card wallet">

                <small>Wallet Balance</small>

                <h2>
                    ₦<?= number_format($balance,2); ?>
                </h2>

                <p>Available Balance</p>

            </div>

            <div class="card">

                <h3>Total Deposit</h3>

                <h2>₦0.00</h2>

                <small>This Month</small>

            </div>

            <div class="card">

                <h3>Total Spent</h3>

                <h2>₦0.00</h2>

                <small>This Month</small>

            </div>

        </div>

        <!-- Quick Actions -->

        <h2 style="margin-top:35px;">
            Quick Actions
        </h2>

        <div class="actions">

            <div class="action-card">📱<br>Airtime</div>

            <div class="action-card">🌐<br>Data</div>

            <div class="action-card">📺<br>Cable</div>

            <div class="action-card">⚡<br>Electricity</div>

            <div class="action-card">💸<br>Transfer</div>

            <div class="action-card">➕<br>More</div>

        </div>

        <!-- Transactions -->

        <h2 style="margin-top:40px;">
            Recent Transactions
        </h2>

        <div class="card" style="margin-top:15px;">

            <p>No transactions yet.</p>

        </div>

    </main>

</div>

<script src="../assets/js/dashboard.js"></script>

</body>
</html>
