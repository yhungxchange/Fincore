<?php

$config = require '../config/database.php';
require '../app/Database.php';

try {
    $db = new Database($config);

    echo "✅ Connected to PostgreSQL successfully!";
} catch (Exception $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
