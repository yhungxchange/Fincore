<?php

$config = require __DIR__ . '/../config/database.php';
require __DIR__ . '/../app/Database.php';

$db = new Database($config);
$pdo = $db->connection();

$stmt = $pdo->query("
SELECT table_name
FROM information_schema.tables
WHERE table_schema='public'
ORDER BY table_name;
");

echo "<h2>Database Tables</h2>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['table_name'] . "<br>";
}
