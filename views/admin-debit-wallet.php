<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Debit Wallet</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">

<link rel="stylesheet" href="/assets/css/admin.css">

</head>

<body>

<div class="dashboard">

<div class="content">

<h1>➖ Debit Wallet</h1>

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

<form action="process-debit.php" method="POST">

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

<label>Reason</label>

<br>

<input
type="text"
name="narration"
placeholder="Reason for debit"
required
class="search-box">

<br><br>

<button
type="submit"
class="search-btn"
style="background:#dc3545;">

Debit Wallet

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
