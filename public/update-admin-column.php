<?php

$config = require __DIR__ . '/../config/database.php';

require __DIR__ . '/../app/Database.php';

$db = new Database($config);

$pdo = $db->connection();

try {

    $pdo->exec("
        ALTER TABLE users
        ADD COLUMN IF NOT EXISTS is_admin BOOLEAN DEFAULT FALSE
    ");

    echo "✅ is_admin column added successfully.";

} catch (PDOException $e) {

    echo "❌ Error: " . $e->getMessage();

}
