<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Users</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">

<link rel="stylesheet" href="/assets/css/admin.css">

</head>

<body>

<div class="dashboard">

<div class="content">

<h1>👥 User Management</h1>

<br>

<table class="admin-table">

<thead>

<tr>

<th>ID</th>

<th>Name</th>

<th>Username</th>

<th>Email</th>

<th>Phone</th>

<th>Wallet</th>

<th>Date Joined</th>

</tr>

</thead>

<tbody>

<?php foreach($users as $user): ?>

<tr>

<td><?= $user['id'] ?></td>

<td><?= htmlspecialchars($user['full_name']) ?></td>

<td><?= htmlspecialchars($user['username']) ?></td>

<td><?= htmlspecialchars($user['email']) ?></td>

<td><?= htmlspecialchars($user['phone']) ?></td>

<td>₦<?= number_format($user['balance'],2) ?></td>

<td><?= date("d M Y",strtotime($user['created_at'])) ?></td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</body>

</html>
