<?php

session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {

    echo json_encode([
        'success' => false,
        'message' => 'Please login first.'
    ]);

    exit;
}

$config = require __DIR__ . '/../config/database.php';

require __DIR__ . '/../app/Database.php';

$db = new Database($config);

$pdo = $db->connection();

$recipient = trim($_POST['recipient'] ?? '');

if ($recipient == '') {

    echo json_encode([
        'success' => false,
        'message' => 'Enter recipient username or email.'
    ]);

    exit;
}

$stmt = $pdo->prepare("
SELECT
id,
fullname,
username,
email
FROM users
WHERE username = :recipient
OR email = :recipient
LIMIT 1
");

$stmt->execute([
    'recipient' => $recipient
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {

    echo json_encode([
        'success' => false,
        'message' => 'Recipient not found.'
    ]);

    exit;
}

if ($user['id'] == $_SESSION['user_id']) {

    echo json_encode([
        'success' => false,
        'message' => 'You cannot transfer to yourself.'
    ]);

    exit;
}

echo json_encode([

    'success' => true,

    'id' => $user['id'],

    'fullname' => $user['fullname'],

    'username' => $user['username'],

    'email' => $user['email']

]);
