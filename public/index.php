<?php

$config = require __DIR__ . '/../config/database.php';

require __DIR__ . '/../app/Database.php';

$db = new Database($config);

$pdo = $db->connection();

/*
|--------------------------------------------------------------------------
| USERS TABLE
|--------------------------------------------------------------------------
*/

$pdo->exec("
CREATE TABLE IF NOT EXISTS users (

    id SERIAL PRIMARY KEY,

    full_name VARCHAR(20) NOT NULL,

    username VARCHAR(15) UNIQUE NOT NULL,

    email VARCHAR(25) UNIQUE NOT NULL,

    phone VARCHAR(14) UNIQUE NOT NULL,

    password_hash TEXT NOT NULL,

    status VARCHAR(20) DEFAULT 'active',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);
");

/*
|--------------------------------------------------------------------------
| WALLETS TABLE
|--------------------------------------------------------------------------
*/

$pdo->exec("
CREATE TABLE IF NOT EXISTS wallets (

    id SERIAL PRIMARY KEY,

    user_id INTEGER UNIQUE NOT NULL,

    balance DECIMAL(15,2) DEFAULT 0.00,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_wallet_user
        FOREIGN KEY(user_id)
        REFERENCES users(id)
        ON DELETE CASCADE

);
");

echo "<h2>✅ FinCore Database Ready</h2>";
echo "<p>Users table created.</p>";
echo "<p>Wallets table created.</p>";
