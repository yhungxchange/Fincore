<?php

$config = require __DIR__ . '/../config/database.php';
require __DIR__ . '/../app/Database.php';

$db = new Database($config);
$pdo = $db->connection();

$sql = "

CREATE TABLE IF NOT EXISTS notifications (

    id SERIAL PRIMARY KEY,

    user_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,

    title VARCHAR(150) NOT NULL,

    message TEXT NOT NULL,

    type VARCHAR(50) NOT NULL,

    is_read BOOLEAN DEFAULT FALSE,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

";

$pdo->exec($sql);

echo "✅ Notifications table created successfully.";
