<?php
/**
 * Loaded first by every page and endpoint.
 * Sets constants, error handling, security headers and shared helpers.
 */
declare(strict_types=1);

const SK_APP = true;
define('APP', __DIR__);
define('ROOT', dirname(__DIR__));
define('STORAGE', ROOT . '/storage');
define('WEB', ROOT . '/public');

$GLOBALS['sk_config'] = require APP . '/config.php';
$GLOBALS['sk_secrets'] = is_file(APP . '/secrets.php')
    ? require APP . '/secrets.php'
    : require APP . '/secrets.example.php';

/* ---------- Errors: log everything, show visitors a calm page ---------- */

ini_set('display_errors', cfg('env') === 'dev' ? '1' : '0');
ini_set('log_errors', '1');
// Compress HTML and JSON if the web server hasn't already (Nginx gzip makes this a no-op).
if (!headers_sent() && extension_loaded('zlib') && !ini_get('zlib.output_compression')) {
    ini_set('zlib.output_compression', '1');
}
error_reporting(E_ALL);

set_error_handler(static function (int $no, string $msg, string $file, int $line): bool {
    if (!(error_reporting() & $no)) {
        return false;
    }
    throw new ErrorException($msg, 0, $no, $file, $line);
});

set_exception_handler(static function (Throwable $e): void {
    error_log('[studio-key] ' . $e::class . ': ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
    if (!headers_sent()) {
        http_response_code(500);
        header('Content-Type: text/html; charset=utf-8');
        header('Cache-Control: no-store');
    }
    // Self-contained so it works even if a partial is what failed.
    $phone = e(cfg('phone_display'));
    $tel = e(cfg('phone_e164'));
    echo '<!doctype html><html lang="en-GB"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">'
        . '<title>Something went wrong | Studio Key</title><meta name="robots" content="noindex"></head>'
        . '<body style="font-family:system-ui,sans-serif;background:#1c1f22;color:#fff;display:grid;place-items:center;min-height:100vh;margin:0;padding:24px">'
        . '<main style="max-width:32rem"><h1>Sorry, something went wrong on my side.</h1>'
        . '<p>I have been told about it. You can still reach me on <a style="color:#14cb94" href="tel:' . $tel . '">' . $phone . '</a> or try <a style="color:#14cb94" href="/">the home page</a>.</p></main></body></html>';
});

/* ---------- Helpers ---------- */

function cfg(string $key, mixed $default = null): mixed
{
    return $GLOBALS['sk_config'][$key] ?? $default;
}

function secret(string $key, mixed $default = null): mixed
{
    return $GLOBALS['sk_secrets'][$key] ?? $default;
}

/** Escape for HTML output. Use on every dynamic value. */
function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Absolute URL for canonical tags, schema and sitemaps. */
function abs_url(string $path = '/'): string
{
    return rtrim((string) cfg('url'), '/') . $path;
}

/** Versioned asset path so caches refresh when files change. */
function asset(string $path): string
{
    $file = WEB . '/assets/' . $path;
    $v = is_file($file) ? substr(md5((string) filemtime($file) . cfg('asset_version')), 0, 8) : cfg('asset_version');
    return '/assets/' . $path . '?v=' . $v;
}

/** Inline Phosphor icon. Icons are stored locally in app/icons. */
function icon(string $name, string $class = 'icon'): string
{
    static $cache = [];
    if (!isset($cache[$name])) {
        $file = APP . '/icons/' . basename($name) . '.svg';
        $cache[$name] = is_file($file) ? (string) file_get_contents($file) : '';
    }
    if ($cache[$name] === '') {
        return '';
    }
    return str_replace('<svg ', '<svg class="' . e($class) . '" aria-hidden="true" focusable="false" ', $cache[$name]);
}

function money(int|float $amount): string
{
    return '£' . (floor($amount) == $amount ? number_format($amount) : number_format($amount, 2));
}

/**
 * Minified CSS for inlining. Minifies once per file change and caches in storage, so there's still no build step.
 */
function inline_css(string $file): string
{
    $src = WEB . '/assets/css/' . basename($file);
    $cache = STORAGE . '/cache-' . md5($src . filemtime($src)) . '.css';
    if (is_file($cache)) {
        return (string) file_get_contents($cache);
    }
    $css = (string) file_get_contents($src);
    $css = preg_replace('#/\*.*?\*/#s', '', $css) ?? $css;
    $css = preg_replace('/\s+/', ' ', $css) ?? $css;
    $css = preg_replace('/\s*([{};,>])\s*/', '$1', $css) ?? $css;
    $css = str_replace(';}', '}', trim($css));
    foreach (glob(STORAGE . '/cache-*.css') ?: [] as $old) {
        @unlink($old);
    }
    @file_put_contents($cache, $css, LOCK_EX);
    return $css;
}

/** Secret used to sign form tokens and hash IPs. Created on first use if not set. */
function app_key(): string
{
    $key = (string) secret('app_key', '');
    if ($key !== '') {
        return $key;
    }
    $file = STORAGE . '/app.key';
    if (is_file($file)) {
        return trim((string) file_get_contents($file));
    }
    $key = bin2hex(random_bytes(32));
    @file_put_contents($file, $key, LOCK_EX);
    @chmod($file, 0600);
    return $key;
}

/** Per-request nonce for the inline <style> block (CSP). */
function csp_nonce(): string
{
    static $nonce = null;
    return $nonce ??= base64_encode(random_bytes(16));
}

/**
 * Tiny inline script that flags JS support before first paint, so the form's steps don't jump.
 * If form.js never loads, it removes the flag and the form falls back to one long page. Allowed by CSP hash.
 */
const JS_FLAG = "var d=document.documentElement;d.classList.add('js');setTimeout(function(){if(!window.SKF&&document.querySelector('[data-form]'))d.classList.remove('js')},6000)";

/* ---------- Security headers ---------- */

function send_security_headers(): void
{
    if (headers_sent()) {
        return;
    }
    $ga = cfg('ga4_id') !== '';
    $script = "'self' 'sha256-" . base64_encode(hash('sha256', JS_FLAG, true)) . "'" . ($ga ? ' https://www.googletagmanager.com' : '');
    $connect = "'self'" . ($ga ? ' https://*.google-analytics.com https://*.analytics.google.com https://www.googletagmanager.com' : '');
    $collector = (string) cfg('collector_url');
    if ($collector !== '') {
        $connect .= ' ' . parse_url($collector, PHP_URL_SCHEME) . '://' . parse_url($collector, PHP_URL_HOST);
    }
    $img = "'self' data:" . ($ga ? ' https://*.google-analytics.com https://www.googletagmanager.com' : '');

    header("Content-Security-Policy: default-src 'self'; script-src {$script}; style-src 'self' 'nonce-" . csp_nonce() . "'; img-src {$img}; font-src 'self'; connect-src {$connect}; media-src 'self'; frame-ancestors 'none'; base-uri 'self'; form-action 'self'; object-src 'none'; upgrade-insecure-requests");
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=(), usb=()');
    header('Cross-Origin-Opener-Policy: same-origin');
    header('X-Frame-Options: DENY');
    if (cfg('env') === 'dev') {
        header('X-Robots-Tag: noindex, nofollow');
    }
}

send_security_headers();
