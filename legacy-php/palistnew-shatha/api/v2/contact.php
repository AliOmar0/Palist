<?php
require_once __DIR__ . '/bootstrap.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    json_out(['error' => 'Method not allowed'], 405);
}

$data = input_json();
$name = trim((string)($data['name'] ?? ''));
$email = trim((string)($data['email'] ?? ''));
$phone = preg_replace('/\D+/', '', (string)($data['phone'] ?? $data['mobile_number'] ?? ''));
$message = trim((string)($data['message'] ?? ''));

if ($name === '' || $message === '') {
    json_out(['error' => 'Name and message are required'], 400);
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    json_out(['error' => 'Invalid email'], 400);
}

$id = db_exec(
    "INSERT INTO contact_form_8363
        (admin_add_id, date_created, deleted, restricted, name, email, mobile_number, telephone, message)
        VALUES (0, NOW(), 0, 0, ?, ?, ?, 0, ?)",
    'ssis',
    [$name, $email, (int)$phone, $message]
);

json_out([
    'id' => $id,
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'message' => $message,
    'createdAt' => date('c'),
], 201);
