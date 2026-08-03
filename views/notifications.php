<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Notifications</title>

<link rel="stylesheet" href="/assets/css/dashboard.css">
<link rel="stylesheet" href="/assets/css/notifications.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="dashboard">

<?php include "sidebar.php"; ?>

<main class="content">

<header class="top-header">

<h1>Notifications</h1>

</header>

<div class="notifications-card">

<?php if(empty($notifications)): ?>

<div class="empty">

<i class="fa-solid fa-bell-slash"></i>

<p>No notifications yet.</p>

</div>

<?php else: ?>

<?php foreach($notifications as $note): ?>

<div class="notification <?= $note['is_read'] ? 'read' : 'unread' ?>">

<h3><?= htmlspecialchars($note['title']) ?></h3>

<p><?= htmlspecialchars($note['message']) ?></p>

<small>

<?= date("d M Y h:i A", strtotime($note['created_at'])) ?>

</small>

</div>

<?php endforeach; ?>

<?php endif; ?>

</div>

</main>

</div>

</body>

</html>
