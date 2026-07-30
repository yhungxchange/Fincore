<?php

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['errors']);
unset($_SESSION['old']);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Create Account | FinCore</title>

<link rel="stylesheet"
href="/assets/css/auth.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="auth-container">

<div class="auth-card">

<img
src="/assets/images/logo.png"
class="auth-logo"
alt="FinCore Logo">

<h2>Create Account</h2>

<p>

Join thousands of users banking smarter with FinCore.

</p>

<?php if(isset($errors['general'])): ?>

<div class="general-error">

<?= htmlspecialchars($errors['general']) ?>

</div>

<?php endif; ?>

<form
action="/register.php"
method="POST"
autocomplete="off">

<div class="input-group">

<i class="fa-solid fa-user"></i>

<input
type="text"
name="full_name"
placeholder="Full Name"
value="<?= htmlspecialchars($old['full_name'] ?? '') ?>">

<?php if(isset($errors['full_name'])): ?>

<small class="error">

<?= htmlspecialchars($errors['full_name']) ?>

</small>

<?php endif; ?>

</div>

<div class="input-group">

<i class="fa-solid fa-at"></i>

<input
type="text"
name="username"
placeholder="Username"
value="<?= htmlspecialchars($old['username'] ?? '') ?>">

<?php if(isset($errors['username'])): ?>

<small class="error">

<?= htmlspecialchars($errors['username']) ?>

</small>

<?php endif; ?>

</div>

<div class="input-group">

<i class="fa-solid fa-envelope"></i>

<input
type="email"
name="email"
placeholder="Email Address"
value="<?= htmlspecialchars($old['email'] ?? '') ?>">

<?php if(isset($errors['email'])): ?>

<small class="error">

<?= htmlspecialchars($errors['email']) ?>

</small>

<?php endif; ?>

</div>

<div class="input-group">

<i class="fa-solid fa-phone"></i>

<input
type="text"
name="phone"
placeholder="Phone Number"
value="<?= htmlspecialchars($old['phone'] ?? '') ?>">

<?php if(isset($errors['phone'])): ?>

<small class="error">

<?= htmlspecialchars($errors['phone']) ?>

</small>

<?php endif; ?>

</div>
<div class="input-group">

<i class="fa-solid fa-lock"></i>

<input
type="password"
name="password"
id="password"
placeholder="Password">

<i
class="fa-solid fa-eye toggle-password"
id="togglePassword"></i>

<?php if(isset($errors['password'])): ?>

<small class="error">

<?= htmlspecialchars($errors['password']) ?>

</small>

<?php endif; ?>

</div>

<div class="terms">

<label>

<input type="checkbox" required>

I agree to the
<a href="#">Terms & Conditions</a>

</label>

</div>

<button
type="submit"
class="auth-btn">

Create Account

</button>

<div class="auth-footer">

Already have an account?

<a href="/login.php">

Login

</a>

</div>

</form>

</div>

</div>

<script>

const togglePassword = document.getElementById('togglePassword');

const password = document.getElementById('password');

togglePassword.addEventListener('click', function(){

if(password.type === 'password'){

password.type = 'text';

this.classList.remove('fa-eye');

this.classList.add('fa-eye-slash');

}else{

password.type = 'password';

this.classList.remove('fa-eye-slash');

this.classList.add('fa-eye');

}

});

</script>

</body>

    </html>
