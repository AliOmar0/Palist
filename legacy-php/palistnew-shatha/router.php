<?php
// Router for PHP's built-in web server. Emulates the Apache .htaccess
// rewrite rules so the site behaves the same in the Replit environment.

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$path = ltrim($uri, '/');

// Serve existing real files / assets directly.
$full = __DIR__ . '/' . $path;
if ($path !== '' && file_exists($full) && !is_dir($full)) {
    $ext = strtolower(pathinfo($full, PATHINFO_EXTENSION));
    // Never serve source of executable/server-side files; execute PHP, refuse
    // the rest. This protects files like panel/core/conn.php (DB credentials)
    // from being dumped as plain text when requested directly.
    $executable = ['php','php3','php4','php5','php7','phtml','phps'];
    if (in_array($ext, $executable, true)) {
        require $full;
        return true;
    }
    // Serve the static file ourselves with an explicit Content-Length and a
    // correct MIME type. Delegating to the built-in server via `return false`
    // is unreliable behind the Replit proxy (it omits Content-Length and
    // closes connections mid-flight under the browser's concurrent asset
    // burst, surfacing as ERR_CONNECTION_CLOSED).
    static $mimes = [
        'css' => 'text/css; charset=UTF-8',
        'js'  => 'application/javascript; charset=UTF-8',
        'mjs' => 'application/javascript; charset=UTF-8',
        'json'=> 'application/json; charset=UTF-8',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg'=> 'image/jpeg',
        'gif' => 'image/gif',
        'webp'=> 'image/webp',
        'svg' => 'image/svg+xml',
        'ico' => 'image/x-icon',
        'bmp' => 'image/bmp',
        'tiff'=> 'image/tiff',
        'avif'=> 'image/avif',
        'woff'=> 'font/woff',
        'woff2'=>'font/woff2',
        'ttf' => 'font/ttf',
        'otf' => 'font/otf',
        'eot' => 'application/vnd.ms-fontobject',
        'mp4' => 'video/mp4',
        'webm'=> 'video/webm',
        'mp3' => 'audio/mpeg',
        'wav' => 'audio/wav',
        'ogg' => 'audio/ogg',
        'pdf' => 'application/pdf',
        'txt' => 'text/plain; charset=UTF-8',
        'xml' => 'application/xml; charset=UTF-8',
        'map' => 'application/json; charset=UTF-8',
        'wasm'=> 'application/wasm',
    ];
    if (!isset($mimes[$ext])) {
        // Default-deny: only known static asset types are served. Blocks
        // operational/source files (error_log, *.sql, *.sh, dotfiles, ...).
        http_response_code(404);
        return true;
    }
    $type = $mimes[$ext];
    $size = filesize($full);
    header('Content-Type: ' . $type);
    header('Content-Length: ' . $size);
    header('Cache-Control: public, max-age=3600');
    header('X-Content-Type-Options: nosniff');
    if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'HEAD') {
        readfile($full);
    }
    return true;
}

// Directory index.
if ($path === '' || is_dir($full)) {
    $index = rtrim($full, '/') . '/index.php';
    if ($path === '') $index = __DIR__ . '/index.php';
    if (file_exists($index)) {
        require $index;
        return true;
    }
}

$listing = ['about_us','news','photos_albums','programs','events','announcements','videos','publications','join_us','internal_system','members','other_laws','trainings_and_workshops'];
$single  = ['single-news','photos','single-program','event','single-announce','page','single_member','law','training_and_workshop'];

// Default language redirects.
if (preg_match('#^(en|ar)/?$#', $path)) {
    require __DIR__ . '/index.php';
    return true;
}

// Listing pages: /{lang}/{section}
if (preg_match('#^(en|ar)/([^/]+)/?$#', $path, $m) && in_array($m[2], $listing, true)) {
    require __DIR__ . '/' . $m[2] . '.php';
    return true;
}

// Single-entry pages: /{lang}/{type}/{slug}
if (preg_match('#^(en|ar)/([^/]+)/([^/]+)/?$#', $path, $m) && in_array($m[2], $single, true)) {
    require __DIR__ . '/' . $m[2] . '.php';
    return true;
}

// Error pages: /error/{name}/{lang}
if (preg_match('#^error/([^/]+)/([a-zA-Z0-9]+)?$#', $path, $m)) {
    $f = __DIR__ . '/legion_' . $m[1] . '.php';
    if (file_exists($f)) { require $f; return true; }
}
if (preg_match('#^error/([^/]+)#', $path, $m)) {
    $f = __DIR__ . '/legion_' . $m[1] . '.php';
    if (file_exists($f)) { require $f; return true; }
}

// Fallback: try the path as a .php file, else home.
$candidate = __DIR__ . '/' . preg_replace('#\.php$#', '', $path) . '.php';
if ($path !== '' && file_exists($candidate)) {
    require $candidate;
    return true;
}

require __DIR__ . '/index.php';
return true;
