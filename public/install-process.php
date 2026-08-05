<?php

session_start();

$configFile = __DIR__ . "/../config/database.php";

$host = trim($_POST['host']);
$database = trim($_POST['database']);
$username = trim($_POST['username']);
$password = trim($_POST['password']);

try{

$dsn = "pgsql:host={$host};dbname={$database}";

$pdo = new PDO($dsn,$username,$password);

$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){

die("

<h2 style='font-family:Segoe UI;color:red;'>

❌ Database Connection Failed

</h2>

<p>{$e->getMessage()}</p>

");

}

/*
|--------------------------------------------------------------------------
| Save Config Automatically
|--------------------------------------------------------------------------
*/

$config = "<?php

return [

'host'=>'{$host}',

'dbname'=>'{$database}',

'username'=>'{$username}',

'password'=>'{$password}',

];

";

file_put_contents($configFile,$config);

/*
|--------------------------------------------------------------------------
| Success
|--------------------------------------------------------------------------
*/

echo "

<h2 style='font-family:Segoe UI;color:green;'>

✅ Database Connected Successfully

</h2>

<p>

Database configuration has been saved.

</p>

<p>

Next Step →

Create all FinCore tables.

</p>

";
