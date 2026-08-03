<?php

$config = require __DIR__ . '/../config/database.php';

require __DIR__ . '/../app/Database.php';

$db = new Database($config);

$pdo = $db->connection();

try {

    $pdo->exec("
        ALTER TABLE users
        ADD COLUMN is_active BOOLEAN DEFAULT TRUE
    ");

    echo "✅ is_active column added successfully.";

} catch (PDOException $e) {

    echo $e->getMessage();

}
