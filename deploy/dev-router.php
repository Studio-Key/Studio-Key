<?php
/**
 * Local preview only: php -S localhost:8080 -t public deploy/dev-router.php
 * Mimics the Nginx rules: folder index.php, 404 page, no direct access to dotfiles except .well-known.
 * Works on Windows, macOS and Linux (paths are normalised before comparing).
 */
$norm = static fn (string $p): string => rtrim(str_replace('\\', '/', $p), '/');
$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/');
$root = $norm((string) realpath(dirname(__DIR__) . '/public'));

if (preg_match('#/\.(?!well-known/)#', $path)) {
    http_response_code(404);
    require $root . '/404.php';
    return true;
}

$real = realpath($root . $path);
$file = $real === false ? '' : $norm($real);

if ($file !== '' && ($file === $root || str_starts_with($file, $root . '/'))) {
    if (is_file($file)) {
        if (str_ends_with($file, '.php')) {
            require $file;
            return true;
        }
        return false; // static file: let the built-in server send it
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
