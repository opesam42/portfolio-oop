<?php
// router.php for PHP built-in server (msostly on devlopment environment)

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve the requested resource as-is if it exists
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Otherwise, route everything to your main index.php
require __DIR__ . '/index.php';
