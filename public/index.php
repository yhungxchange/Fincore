<?php

$config = require __DIR__ . '/../config/database.php';

require __DIR__ . '/../app/Database.php';

$db = new Database($config);

$pdo = $db->connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo "Registration form submitted!";
    exit;

}

require __DIR__ . '/../views/register.php';
