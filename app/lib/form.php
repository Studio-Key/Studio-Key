<?php
/**
 * Enquiry form: options, token, spam checks, rate limit and validation.
 * Stateless token (HMAC of a timestamp) so pages stay cache-friendly and set no session cookie.
 */
defined('SK_APP') || exit;

const FORM_MIN_SECONDS = 3;
const FORM_MAX_AGE = 172800;      // 2 days
const RATE_LIMIT = 5;             // submissions
const RATE_WINDOW = 3600;         // per hour

function form_needs(): array
{
    return [
        'move'  => ['label' => 'Move my existing website', 'hint' => 'I move it for you, free'],
        'new'   => ['label' => 'Hosting for a new website', 'hint' => 'First time, or a new domain'],
        'check' => ['label' => 'A free check of my current hosting', 'hint' => 'What you pay for, and what you get'],
        'unsure' => ['label' => 'Not sure yet', 'hint' => 'Tell me a bit and I\'ll point you in the right direction'],
    ];
}

function form_pains(): array
{
    return [
        'fees'     => 'Surprise fees or renewals',
        'cost'     => 'Paying too much',
        'support'  => 'Slow or no support',
        'backups'  => 'Not sure I have backups',
        'control'  => 'Don\'t know who controls my site',
        'slow'     => 'Slow website',
    ];
}

function form_replies(): array
{
    return ['email' => 'Email', 'call' => 'Phone call', 'whatsapp' => 'WhatsApp'];
}

function form_token(): string
{
    $ts = (string) time();
    return $ts . '.' . hash_hmac('sha256', 'enquiry|' . $ts, app_key());
}

/** Returns null if valid, or an error code. */
function form_check_token(string $token): ?string
{
    [$ts, $sig] = array_pad(explode('.', $token, 2), 2, '');
    if (!ctype_digit($ts) || !hash_equals(hash_hmac('sha256', 'enquiry|' . $ts, app_key()), $sig)) {
        return 'token';
    }
    $age = time() - (int) $ts;
    if ($age < FORM_MIN_SECONDS) {
        return 'too_fast';
    }
    if ($age > FORM_MAX_AGE) {
        return 'expired';
    }
    return null;
}

function client_ip_hash(): string
{
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    return hash_hmac('sha256', (string) $ip, app_key());
}

/** True if this visitor is under the limit. Records the attempt. Fails open if storage is not writable. */
function rate_limit_ok(): bool
{
    $dir = STORAGE . '/ratelimit';
    if (!is_dir($dir) || !is_writable($dir)) {
        error_log('[studio-key] rate limit storage not writable');
        return true;
    }
    $file = $dir . '/' . client_ip_hash() . '.json';
    $now = time();
    $hits = [];
    if (is_file($file)) {
        $hits = json_decode((string) file_get_contents($file), true) ?: [];
    }
    $hits = array_values(array_filter($hits, static fn ($t) => is_int($t) && $t > $now - RATE_WINDOW));
    if (count($hits) >= RATE_LIMIT) {
        return false;
    }
    $hits[] = $now;
    file_put_contents($file, json_encode($hits), LOCK_EX);

    // Tidy old files now and then.
    if (random_int(1, 50) === 1) {
        foreach (glob($dir . '/*.json') ?: [] as $f) {
            if (filemtime($f) < $now - RATE_WINDOW) {
                @unlink($f);
            }
        }
    }
    return true;
}

function clean_text(mixed $value, int $max): string
{
    $value = is_string($value) ? $value : '';
    $value = str_replace(["\r\n", "\r"], "\n", $value);
    $value = preg_replace('/[^\P{C}\n]/u', '', $value) ?? '';
    return mb_substr(trim($value), 0, $max);
}

function clean_line(mixed $value, int $max): string
{
    return str_replace("\n", ' ', clean_text($value, $max));
}

/**
 * Validates POST data. Returns ['data' => [...], 'errors' => [field => message]].
 */
function form_validate(array $in): array
{
    $errors = [];
    $need = is_string($in['need'] ?? null) && isset(form_needs()[$in['need']]) ? $in['need'] : '';
    if ($need === '') {
        $errors['need'] = 'Pick the option that fits best.';
    }

    $pains = array_values(array_intersect(array_keys(form_pains()), (array) ($in['pains'] ?? [])));
    $reply = is_string($in['reply'] ?? null) && isset(form_replies()[$in['reply']]) ? $in['reply'] : 'email';

    $data = [
        'need'      => $need,
        'website'   => clean_line($in['website'] ?? '', 200),
        'host'      => clean_line($in['host'] ?? '', 100),
        'domain'    => clean_line($in['domain'] ?? '', 200),
        'build'     => ($in['build'] ?? '') === 'yes' ? 'yes' : 'no',
        'pains'     => $pains,
        'name'      => clean_line($in['name'] ?? '', 100),
        'email'     => clean_line($in['email'] ?? '', 254),
        'phone'     => clean_line($in['phone'] ?? '', 30),
        'reply'     => $reply,
        'message'   => clean_text($in['message'] ?? '', 2000),
        'tips'      => ($in['tips'] ?? '') === 'yes',
        'plan'      => is_string($in['plan'] ?? null) && isset(cfg('plans')[$in['plan']]) ? $in['plan'] : '',
        'utm'       => [],
        'page'      => clean_line($in['page'] ?? '', 200),
        'referrer'  => clean_line($in['referrer'] ?? '', 300),
        'landing'   => clean_line($in['landing'] ?? '', 300),
    ];
    foreach (['source', 'medium', 'campaign', 'term', 'content'] as $k) {
        $v = clean_line($in['utm_' . $k] ?? '', 100);
        if ($v !== '') {
            $data['utm'][$k] = $v;
        }
    }

    if ($data['name'] === '') {
        $errors['name'] = 'Please tell me your name.';
    }
    if ($data['email'] === '' || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please check your email address.';
    }
    if ($data['phone'] !== '' && !preg_match('/^[0-9 +()\-]{7,30}$/', $data['phone'])) {
        $errors['phone'] = 'Please check your phone number.';
    }
    if (in_array($reply, ['call', 'whatsapp'], true) && $data['phone'] === '') {
        $errors['phone'] = 'I need a number to ' . ($reply === 'call' ? 'call you' : 'WhatsApp you') . '.';
    }
    return ['data' => $data, 'errors' => $errors];
}

/** Plain-text summary used in notification emails and the lead log. */
function form_summary(array $d): string
{
    $lines = [
        'Need: ' . (form_needs()[$d['need']]['label'] ?? $d['need']),
        'Plan: ' . ($d['plan'] !== '' ? cfg('plans')[$d['plan']]['name'] : '-'),
        'Name: ' . $d['name'],
        'Email: ' . $d['email'],
        'Phone: ' . ($d['phone'] ?: '-'),
        'Reply by: ' . form_replies()[$d['reply']],
        'Website: ' . ($d['website'] ?: '-'),
        'Current host: ' . ($d['host'] ?: '-'),
        'Domain: ' . ($d['domain'] ?: '-'),
        'Needs a website built: ' . $d['build'],
        'Bugging them: ' . ($d['pains'] ? implode(', ', array_map(static fn ($p) => form_pains()[$p], $d['pains'])) : '-'),
        'Hosting tips: ' . ($d['tips'] ? 'yes' : 'no'),
        '',
        'Message:',
        $d['message'] ?: '-',
        '',
        'Page: ' . ($d['page'] ?: '-'),
        'Landing page: ' . ($d['landing'] ?: '-'),
        'Referrer: ' . ($d['referrer'] ?: '-'),
        'UTM: ' . ($d['utm'] ? http_build_query($d['utm'], '', ', ') : '-'),
    ];
    return implode("\n", $lines);
}

/** Last resort so a lead is never lost. Outside the web root. */
function lead_log(array $d, string $reason): bool
{
    $dir = STORAGE . '/leads';
    if (!is_dir($dir) || !is_writable($dir)) {
        error_log('[studio-key] LEAD NOT STORED (' . $reason . '): ' . json_encode($d));
        return false;
    }
    $row = json_encode(['at' => date('c'), 'reason' => $reason, 'lead' => $d], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    return file_put_contents($dir . '/' . date('Y-m') . '.jsonl', $row . "\n", FILE_APPEND | LOCK_EX) !== false;
}
