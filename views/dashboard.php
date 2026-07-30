<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FinCore Dashboard</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<body>

<div class="dashboard">

    <!-- Sidebar -->

    <aside class="sidebar" id="sidebar">

        <div class="logo">

            <h2>FinCore</h2>

            <p>Digital Banking</p>

        </div>

        <ul class="menu">

<li class="active">
<a href="#">
<i class="fa-solid fa-house"></i>
<span>Dashboard</span>
</a>
</li>

<li>
<a href="#">
<i class="fa-solid fa-wallet"></i>
<span>Wallet</span>
</a>
</li>

<li>
<a href="#">
<i class="fa-solid fa-money-bill-transfer"></i>
<span>Transfer</span>
</a>
</li>

<li>
<a href="#">
<i class="fa-solid fa-mobile-screen"></i>
<span>Airtime</span>
</a>
</li>

<li>
<a href="#">
<i class="fa-solid fa-wifi"></i>
<span>Data</span>
</a>
</li>

<li>
<a href="#">
<i class="fa-solid fa-tv"></i>
<span>Cable TV</span>
</a>
</li>

<li>
<a href="#">
<i class="fa-solid fa-bolt"></i>
<span>Electricity</span>
</a>
</li>

<li>
<a href="#">
<i class="fa-solid fa-clock-rotate-left"></i>
<span>Transactions</span>
</a>
</li>

<li>
<a href="#">
<i class="fa-solid fa-user"></i>
<span>Profile</span>
</a>
</li>

<li>
<a href="#">
<i class="fa-solid fa-gear"></i>
<span>Settings</span>
</a>
</li>

<li>
<a href="logout.php">
<i class="fa-solid fa-right-from-bracket"></i>
<span>Logout</span>
</a>
</li>

    </ul>

    </aside>

    <!-- Main -->

    <main class="main">

        <!-- Top Bar -->

        <header class="topbar">

            <button class="menu-btn" id="menuBtn">
                ☰
            </button>

            <div class="welcome">

                <h2>
                    Welcome,
                    <?= htmlspecialchars($_SESSION['username']); ?>
                </h2>

                <span>
                    FinCore Digital Banking
                </span>

            </div>

            <div class="profile">

                🔔

                <div class="avatar">

                    <?= strtoupper(substr($_SESSION['username'],0,1)); ?>

                </div>

            </div>

        </header>

        <!-- Wallet section starts here -->

        <section id="wallet-section">

    <div class="cards">

        <!-- Wallet Card -->

        <div class="wallet-card">

            <div class="wallet-header">

                <div>

                    <p>Available Balance</p>

                    <h1>
                        ₦<?= number_format($balance,2); ?>
                    </h1>

                </div>

                <div class="wallet-icon">
                    💳
                </div>

            </div>

            <div class="wallet-buttons">

                <button class="deposit-btn">

                    💰 Deposit

                </button>

                <button class="transfer-btn">

                    💸 Transfer

                </button>

            </div>

        </div>

        <!-- Statistics -->

        <div class="stats-card">

            <h3>Total Deposit</h3>

            <h2>₦0.00</h2>

            <span>This Month</span>

        </div>

        <div class="stats-card">

            <h3>Total Transfer</h3>

            <h2>₦0.00</h2>

            <span>This Month</span>

        </div>

        <div class="stats-card">

            <h3>Total Transactions</h3>

            <h2>0</h2>

            <span>Completed</span>

        </div>

    </div>

    <!-- Quick Actions -->

    <div class="quick-actions">

        <h2>Quick Actions</h2>

        <div class="actions-grid">

            <div class="action-box">
                📱
                <span>Airtime</span>
            </div>

            <div class="action-box">
                🌐
                <span>Data</span>
            </div>

            <div class="action-box">
                📺
                <span>Cable TV</span>
            </div>

            <div class="action-box">
                ⚡
                <span>Electricity</span>
            </div>

            <div class="action-box">
                💸
                <span>Transfer</span>
            </div>

            <div class="action-box">
                ➕
                <span>More</span>
            </div>

        </div>

        <!-- Recent Transactions -->

<div class="transactions">

    <h2>Recent Transactions</h2>

    <div class="transaction-card">

        <table class="transaction-table">

            <tr>
                <th>Type</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>

            <tr>
                <td>No Transactions Yet</td>
                <td>₦0.00</td>
                <td class="status-pending">
                    Waiting
                </td>
            </tr>

        </table>

    </div>

</div>

</section>

</main>

</div>

<script src="assets/js/dashboard.js"></script>

</body>
        </html>
