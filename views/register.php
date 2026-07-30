<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - FinCore</title>
</head>
<body>

<h2>Create Your FinCore Account</h2>

<form method="POST">

    <label>Full Name</label><br>
    <input type="text" name="full_name" required><br><br>

    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Email Address</label><br>
    <input type="email" name="email" required><br><br>

    <label>Phone Number</label><br>
    <input type="text" name="phone" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">
        Create Account
    </button>

</form>

<br>

<p>
Already have an account?
<a href="login.php">Login</a>
</p>

</body>
</html>
