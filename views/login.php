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

<title>

Login | FinCore

</title>

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

<h2>

Welcome Back 👋

</h2>

<p>

Sign in to continue to your FinCore account.

</p>

<?php if(isset($errors['general'])): ?>

<div class="general-error">

<?= htmlspecialchars($errors['general']) ?>

</div>

<?php endif; ?>

<form
action=""
method="POST">

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

<i class="fa-solid fa-lock"></i>

<input

type="password"

name="password"

id="password"

placeholder="Password">

<i

class="fa-solid fa-eye toggle-password"

id="togglePassword">

</i>

<?php if(isset($errors['password'])): ?>

<small class="error">

<?= htmlspecialchars($errors['password']) ?>

</small>

<?php endif; ?>

</div>

<button
type="submit"
class="auth-btn">

Login

</button>

<div class="auth-footer">

<p>

Don't have an account?

<a href="/register.php">

Create One

</a>

</p>

</div>

</form>

</div>

</div>

<script>

const password=document.getElementById("password");

const toggle=document.getElementById("togglePassword");

toggle.addEventListener("click",function(){

if(password.type==="password"){

password.type="text";

this.classList.remove("fa-eye");

this.classList.add("fa-eye-slash");

}else{

password.type="password";

this.classList.remove("fa-eye-slash");

this.classList.add("fa-eye");

}

});

</script>

</body>

</html>
