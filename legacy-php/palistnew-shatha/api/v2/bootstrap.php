<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: ' . ($_SERVER['HTTP_ORIGIN'] ?? '*'));
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once __DIR__ . '/../../panel/core/conn.php';

mysqli_set_charset($conn, 'utf8');

function json_out($payload, int $status = 200): void
{
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function db_all(string $sql, string $types = '', array $params = []): array
{
    global $conn;

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        json_out(['error' => 'Query prepare failed'], 500);
    }

    if ($types !== '') {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    mysqli_stmt_close($stmt);
    return $rows;
}

function db_one(string $sql, string $types = '', array $params = []): ?array
{
    $rows = db_all($sql, $types, $params);
    return $rows[0] ?? null;
}

function db_exec(string $sql, string $types = '', array $params = []): int
{
    global $conn;

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        json_out(['error' => 'Query prepare failed'], 500);
    }

    if ($types !== '') {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    $id = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt);

    return (int)$id;
}

function input_json(): array
{
    $raw = file_get_contents('php://input') ?: '';
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

function ml_parts(?string $value): array
{
    $parts = array_map('trim', explode('<>', (string)$value));
    $parts = array_values(array_filter($parts, static fn($part) => $part !== ''));

    if (!$parts) {
        return ['ar' => '', 'en' => null];
    }

    $en = $parts[0] ?? null;
    $ar = $parts[1] ?? $parts[0];

    return ['ar' => $ar, 'en' => $en];
}

function upload_url(?string $file): ?string
{
    $file = trim((string)$file);
    if ($file === '') {
        return null;
    }

    if (preg_match('/^https?:\/\//i', $file)) {
        return $file;
    }

    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');
    $origin = ($isHttps ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? '');
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    $projectBase = preg_replace('#/api/v2$#', '', $scriptDir);

    return $origin . $projectBase . '/uploads/' . rawurlencode($file);
}

function date_or_created(?string $primary, ?string $fallback): ?string
{
    $date = $primary ?: $fallback;
    if (!$date || str_starts_with($date, '0000-00-00')) {
        return null;
    }

    return $date;
}
