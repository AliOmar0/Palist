<?php
require_once __DIR__ . '/bootstrap.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET') {
    json_out(['error' => 'Method not allowed'], 405);
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

$select = "SELECT id, title, photo, summary, content, publish_date, date_created
    FROM news_8362
    WHERE deleted = 0 AND restricted = 0";

if ($id) {
    $row = db_one($select . " AND id = ? LIMIT 1", 'i', [$id]);
    if (!$row) {
        json_out(['error' => 'Not found'], 404);
    }

    json_out(map_news($row));
}

$rows = db_all($select . " ORDER BY COALESCE(publish_date, DATE(date_created)) DESC, id DESC");
json_out(array_map('map_news', $rows));

function map_news(array $row): array
{
    $title = ml_parts($row['title'] ?? '');
    $summary = ml_parts($row['summary'] ?? '');
    $content = ml_parts($row['content'] ?? '');

    return [
        'id' => (int)$row['id'],
        'titleAr' => $title['ar'],
        'titleEn' => $title['en'],
        'summaryAr' => $summary['ar'] ?: null,
        'summaryEn' => $summary['en'],
        'contentAr' => $content['ar'] ?: null,
        'contentEn' => $content['en'],
        'coverImage' => upload_url($row['photo'] ?? null),
        'category' => null,
        'publishedAt' => date_or_created($row['publish_date'] ?? null, $row['date_created'] ?? null),
    ];
}
