<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>FinCore Installer</title>

<style>

body{

background:#f5f7fb;

font-family:Segoe UI;

display:flex;

justify-content:center;

align-items:center;

height:100vh;

margin:0;

}

.card{

width:420px;

background:#fff;

padding:35px;

border-radius:20px;

box-shadow:0 10px 30px rgba(0,0,0,.08);

}

h2{

text-align:center;

color:#6D4DFF;

margin-bottom:25px;

}

input{

width:100%;

padding:14px;

margin-bottom:18px;

border:1px solid #ddd;

border-radius:10px;

font-size:15px;

box-sizing:border-box;

}

button{

width:100%;

padding:15px;

border:none;

background:#6D4DFF;

color:#fff;

font-size:16px;

font-weight:bold;

border-radius:10px;

cursor:pointer;

}

button:hover{

background:#5535dd;

}

</style>

</head>

<body>

<div class="card">

<h2>FinCore Installer</h2>

<form method="POST" action="install-process.php">

<input
type="text"
name="host"
placeholder="Database Host"
required>

<input
type="text"
name="database"
placeholder="Database Name"
required>

<input
type="text"
name="username"
placeholder="Database Username"
required>

<input
type="password"
name="password"
placeholder="Database Password">

<button type="submit">

Install FinCore

</button>

</form>

</div>

</body>

</html>
