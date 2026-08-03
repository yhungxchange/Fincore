<?php

$config = require __DIR__ . '/../config/database.php';

require __DIR__ . '/../app/Database.php';

$db = new Database($config);

$pdo = $db->connection();

/*
|--------------------------------------------------------------------------
| CHANGE THIS EMAIL
|--------------------------------------------------------------------------
*/

$email = "YOUR_EMAIL_HERE";

$stmt = $pdo->prepare("
    UPDATE users
    SET is_admin = TRUE
    WHERE email = :email
");

$stmt->execute([
    "email" => $email
]);

echo "✅ Admin access granted successfully.";
