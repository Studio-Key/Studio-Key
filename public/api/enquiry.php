<?php
/**
 * POST /api/enquiry.php
 * JSON for fetch() requests, redirect back to /contact/ for plain form posts (no JavaScript).
 */
require __DIR__ . '/../../app/bootstrap.php';
require APP . '/lib/form.php';
require APP . '/lib/brevo.php';

header('Cache-Control: no-store');
$wants_json = str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json');

function respond(int $code, array $body, bool $json): never
{
    if ($json) {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($body, JSON_UNESCAPED_UNICODE);
    } else {
        header('Location: /contact/?status=' . ($body['ok'] ? 'sent' : 'error') . '#enquiry', true, 303);
    }
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Allow: POST');
    respond(405, ['ok' => false, 'message' => 'Please use the form.'], true);
}

// Same-origin check. Browsers send Origin on POST; reject other sites.
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if ($origin !== '') {
    $host = parse_url($origin, PHP_URL_HOST);
    if ($host !== ($_SERVER['HTTP_HOST'] ?? '') && $host !== parse_url((string) cfg('url'), PHP_URL_HOST)
        && strtok((string) ($_SERVER['HTTP_HOST'] ?? ''), ':') !== $host) {
        respond(403, ['ok' => false, 'message' => 'Please send the form from this website.'], $wants_json);
    }
}

$len = (int) ($_SERVER['CONTENT_LENGTH'] ?? 0);
if ($len > 20000) {
    respond(413, ['ok' => false, 'message' => 'That message is too long. Please shorten it or call me.'], $wants_json);
}

// Honeypot: pretend it worked so bots learn nothing.
if (trim((string) ($_POST['company_url'] ?? '')) !== '') {
    respond(200, ['ok' => true], $wants_json);
}

$token_error = form_check_token((string) ($_POST['token'] ?? ''));
if ($token_error === 'too_fast') {
    respond(200, ['ok' => true], $wants_json);
}
if ($token_error === 'expired') {
    respond(400, ['ok' => false, 'message' => 'This page has been open a while. Please refresh it and send again, your answers will need re-entering.'], $wants_json);
}
if ($token_error !== null) {
    respond(400, ['ok' => false, 'message' => 'Something went wrong with the form. Please refresh the page and try again.'], $wants_json);
}

if (!rate_limit_ok()) {
    respond(429, ['ok' => false, 'message' => 'You\'ve sent a few messages already. Please call or WhatsApp me on ' . cfg('phone_display') . '.'], $wants_json);
}

['data' => $data, 'errors' => $errors] = form_validate($_POST);
if ($errors) {
    respond(422, ['ok' => false, 'message' => 'Please check the highlighted fields.', 'errors' => $errors], $wants_json);
}

try {
    $delivered = deliver_lead($data);
} catch (Throwable $e) {
    error_log('[studio-key] deliver_lead: ' . $e->getMessage());
    $delivered = false;
}
if (!$delivered) {
    lead_log($data, 'delivery_failed');
}

// The lead is either delivered or safely logged, so the visitor always sees success.
respond(200, ['ok' => true, 'name' => explode(' ', $data['name'])[0]], $wants_json);
