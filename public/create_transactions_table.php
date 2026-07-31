<?php

$config = require __DIR__ . '/../config/database.php';
require __DIR__ . '/../app/Database.php';

$db = new Database($config);
$pdo = $db->connection();

$sql = "

CREATE TABLE IF NOT EXISTS transactions (

id SERIAL PRIMARY KEY,

user_id INTEGER NOT NULL,

type VARCHAR(50) NOT NULL,

description TEXT,

amount NUMERIC(15,2) NOT NULL DEFAULT 0,

balance_before NUMERIC(15,2) NOT NULL DEFAULT 0,

balance_after NUMERIC(15,2) NOT NULL DEFAULT 0,

status VARCHAR(20) NOT NULL DEFAULT 'successful',

reference VARCHAR(100) UNIQUE,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

CONSTRAINT fk_transactions_user

FOREIGN KEY (user_id)

REFERENCES users(id)

ON DELETE CASCADE

);

";

try{

$pdo->exec($sql);

echo "✅ Transactions table created successfully.";

}catch(PDOException $e){

echo $e->getMessage();

}
