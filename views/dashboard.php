<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinCore Dashboard</title>
</head>

<body>

    <h2>
        Welcome back,
        <?php echo htmlspecialchars($_SESSION['username']); ?>
        👋
    </h2>

    <hr>

    <h3>Wallet Balance</h3>

    <h1>₦0.00</h1>

    <hr>

    <button>💰 Deposit</button>

    <button>💸 Transfer</button>

    <button>📜 Transactions</button>

    <button>👤 Profile</button>

    <button>🚪 Logout</button>

</body>

</html>
