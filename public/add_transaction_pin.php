<?php

$config = require __DIR__ . '/../config/database.php';
require __DIR__ . '/../app/Database.php';

$db = new Database($config);
$pdo = $db->connection();

try {

    $pdo->exec("
        ALTER TABLE users
        ADD COLUMN transaction_pin VARCHAR(255);
    ");

    echo "<h2>✅ Transaction PIN column added successfully.</h2>";

} catch (PDOException $e) {

    if (str_contains($e->getMessage(), 'already exists')) {

        echo "<h2>ℹ️ Transaction PIN column already exists.</h2>";

    } else {

        echo "<h2>❌ Error:</h2>";
        echo $e->getMessage();

    }

}
