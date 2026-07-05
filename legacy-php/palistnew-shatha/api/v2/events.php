<?php
require_once __DIR__ . '/bootstrap.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET') {
    json_out(['error' => 'Method not allowed'], 405);
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

$select = "SELECT id, title, event_date, events_description, photo, date_created
    FROM events_8362
    WHERE deleted = 0 AND restricted = 0";

if ($id) {
    $row = db_one($select . " AND id = ? LIMIT 1", 'i', [$id]);
    if (!$row) {
        json_out(['error' => 'Not found'], 404);
    }

    json_out(map_event($row));
}

$rows = db_all($select . " ORDER BY COALESCE(event_date, DATE(date_created)) DESC, id DESC");
json_out(array_map('map_event', $rows));

function map_event(array $row): array
{
    $title = ml_parts($row['title'] ?? '');
    $description = ml_parts($row['events_description'] ?? '');

    return [
        'id' => (int)$row['id'],
        'titleAr' => $title['ar'],
        'titleEn' => $title['en'],
        'descriptionAr' => $description['ar'] ?: null,
        'descriptionEn' => $description['en'],
        'coverImage' => upload_url($row['photo'] ?? null),
        'location' => null,
        'startsAt' => date_or_created($row['event_date'] ?? null, $row['date_created'] ?? null),
        'endsAt' => null,
        'audience' => 'all',
    ];
}
