<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Credit Wallet</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">

<link rel="stylesheet" href="/assets/css/admin.css">

</head>

<body>

<div class="dashboard">

<div class="content">

<h1>💰 Credit Wallet</h1>

<br>

<div class="admin-card">

<h2><?= htmlspecialchars($user['full_name']) ?></h2>

<p>

Current Balance:

<strong>

₦<?= number_format($user['balance'],2) ?>

</strong>

</p>

<br>

<form action="process-credit.php" method="POST">

<input
type="hidden"
name="user_id"
value="<?= $user['id'] ?>">

<label>Amount</label>

<br>

<input
type="number"
name="amount"
step="0.01"
required
class="search-box">

<br><br>

<label>Narration</label>

<br>

<input
type="text"
name="narration"
placeholder="Reason for credit"
required
class="search-box">

<br><br>

<button
type="submit"
class="search-btn">

Credit Wallet

</button>

<a
href="view-user.php?id=<?= $user['id'] ?>"
class="search-btn"
style="background:#888;">

Cancel

</a>

</form>

</div>

</div>

</div>

</body>

</html>
