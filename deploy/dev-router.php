<?php
/**
 * Local preview only: php -S localhost:8080 -t public deploy/dev-router.php
 * Mimics the Nginx rules: folder index.php, 404 page, no direct access to dotfiles except .well-known.
 */
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
$root = dirname(__DIR__) . '/public';
if (preg_match('#/\.(?!well-known/)#', $path)) {
    http_response_code(404);
    require $root . '/404.php';
    return true;
}
$file = realpath($root . $path);
if ($file && str_starts_with($file, $root)) {
    if (is_file($file)) {
        return false; // let the built-in server handle it
    }
    if (is_dir($file)) {
        if (!str_ends_with($path, '/')) {
            header('Location: ' . $path . '/', true, 301);
            return true;
        }
        if (is_file($file . '/index.php')) {
            require $file . '/index.php';
            return true;
        }
    }
}
require $root . '/404.php';
return true;
