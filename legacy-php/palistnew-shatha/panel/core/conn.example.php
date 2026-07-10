<?php
// Database connection for the Legion CMS and the api/v2 endpoints.
//
// This is a TEMPLATE. Copy it to conn.php (which is gitignored because it
// holds credentials) and adjust the values / env vars for your environment.
//
//   copy conn.example.php conn.php      (Windows)
//   cp   conn.example.php conn.php      (macOS/Linux)
//
// Values can be provided via environment variables (recommended for
// production) or fall back to the local defaults below.

$dbHost     = getenv('LEGION_DB_HOST') ?: '127.0.0.1';
$dbUser     = getenv('LEGION_DB_USER') ?: 'root';
$dbPassword = getenv('LEGION_DB_PASS') ?: '';
$dbName     = getenv('LEGION_DB_NAME') ?: 'palist_legion';
$dbPort     = (int)(getenv('LEGION_DB_PORT') ?: 3306);

$conn = @mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName, $dbPort);

if (!$conn) {
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

mysqli_set_charset($conn, 'utf8mb4');
