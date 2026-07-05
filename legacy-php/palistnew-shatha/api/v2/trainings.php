<?php
require_once __DIR__ . '/bootstrap.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET') {
    json_out(['error' => 'Method not allowed'], 405);
}

$rows = db_all("SELECT id, photo, title, content, publish_date, date_created
    FROM programs_and_training_8366
    WHERE deleted = 0 AND restricted = 0
    ORDER BY COALESCE(publish_date, DATE(date_created)) DESC, id DESC");

json_out(array_map(static function (array $row): array {
    $title = ml_parts($row['title'] ?? '');
    $content = ml_parts($row['content'] ?? '');

    return [
        'id' => (int)$row['id'],
        'titleAr' => $title['ar'],
        'titleEn' => $title['en'],
        'descriptionAr' => $content['ar'] ?: null,
        'descriptionEn' => $content['en'],
        'coverImage' => upload_url($row['photo'] ?? null),
        'category' => null,
        'durationHours' => null,
        'startsAt' => date_or_created($row['publish_date'] ?? null, $row['date_created'] ?? null),
        'registrationUrl' => null,
    ];
}, $rows));
