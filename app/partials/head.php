<?php
/**
 * Expects $page = ['id', 'title', 'description', 'path', 'schema' => [] (optional), 'robots' => (optional)].
 * CSS is inlined so the first paint is fully styled (no FOUC) with zero extra requests.
 */
defined('SK_APP') || exit;

$canonical = abs_url($page['path']);
$robots = $page['robots'] ?? (cfg('env') === 'dev' ? 'noindex, nofollow' : 'index, follow, max-image-preview:large');
$css = inline_css('site.css');
?>
<!doctype html>
<html lang="en-GB" data-page="<?= e($page['id']) ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<script><?= JS_FLAG ?></script>
<title><?= e($page['title']) ?></title>
<meta name="description" content="<?= e($page['description']) ?>">
<meta name="robots" content="<?= e($robots) ?>">
<link rel="canonical" href="<?= e($canonical) ?>">
<link rel="preload" href="/assets/fonts/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>
<style nonce="<?= e(csp_nonce()) ?>"><?= $css ?></style>
<link rel="icon" href="/favicon.ico" sizes="32x32">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="manifest" href="/site.webmanifest">
<meta name="theme-color" content="#1c1f22">
<meta name="color-scheme" content="light">
<meta name="author" content="Rich, Studio Key">
<meta name="geo.region" content="GB-NTH">
<meta name="geo.placename" content="Corby">
<meta property="og:type" content="website">
<meta property="og:locale" content="en_GB">
<meta property="og:site_name" content="Studio Key">
<meta property="og:title" content="<?= e($page['title']) ?>">
<meta property="og:description" content="<?= e($page['description']) ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:image" content="<?= e(abs_url('/assets/img/og.png')) ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="Studio Key: personal website hosting from Rich in Corby">
<meta name="twitter:card" content="summary_large_image">
<link rel="alternate" type="text/plain" href="/llms.txt" title="LLM summary">
<link rel="author" type="text/plain" href="/humans.txt">
<script type="application/json" id="sk-config"><?= json_encode([
    'ga4' => cfg('ga4_id'),
    'collector' => cfg('collector_url'),
], JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) ?></script>
<script src="<?= e(asset('js/main.js')) ?>" defer></script>
<?php include APP . '/partials/schema.php'; ?>
</head>
