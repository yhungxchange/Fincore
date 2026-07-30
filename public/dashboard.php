<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>FinCore Dashboard</title>
</head>
<body>

<h1>Welcome to FinCore 🎉</h1>

<p>Hello, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>

<p>You have successfully logged in.</p>

</body>
</html>
