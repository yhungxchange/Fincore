<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Account Locked</title>

<link rel="stylesheet" href="/assets/css/account-locked.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="locked-card">

<div class="icon">

<i class="fa-solid fa-lock"></i>

</div>

<h1>Account Locked</h1>

<p><?= htmlspecialchars($message) ?></p>

<a
href="https://wa.me/2349061389641?text=Hello%20FinCore%20Support,%20my%20account%20has%20been%20locked."
target="_blank"
class="btn support">

<i class="fa-brands fa-whatsapp"></i>

Contact Support

</a>

<a href="login.php" class="btn login">

<i class="fa-solid fa-arrow-left"></i>

Back to Login

</a>

</div>

</body>

</html>
