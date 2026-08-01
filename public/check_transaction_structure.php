<?php

$config = require __DIR__ . '/../config/database.php';
require __DIR__ . '/../app/Database.php';

$db = new Database($config);
$pdo = $db->connection();

$stmt = $pdo->query("
SELECT
    column_name,
    data_type
FROM information_schema.columns
WHERE table_name = 'transactions'
ORDER BY ordinal_position
");

echo "<pre>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($row);
}

echo "</pre>";
