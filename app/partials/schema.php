<?php
/**
 * JSON-LD for every page, plus page-specific nodes passed in $page['schema'].
 * No AggregateRating: Google ignores self-serving review markup for local businesses.
 */
defined('SK_APP') || exit;

$org_id = abs_url('/#organisation');
$graph = [
    [
        '@type' => ['ProfessionalService', 'Organization'],
        '@id' => $org_id,
        'name' => cfg('name'),
        'legalName' => cfg('legal_name'),
        'url' => abs_url('/'),
        'logo' => abs_url('/assets/img/logo-dark.svg'),
        'image' => abs_url('/assets/img/og.png'),
        'description' => 'Independent website hosting for small businesses in Corby and across the East Midlands, with one clear yearly price and direct support from Rich.',
        'telephone' => cfg('phone_e164'),
        'email' => cfg('email'),
        'priceRange' => '£119 to £450 a year',
        'currenciesAccepted' => 'GBP',
        'identifier' => ['@type' => 'PropertyValue', 'propertyID' => 'Companies House', 'value' => cfg('company_no')],
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => cfg('locality'),
            'addressRegion' => cfg('region'),
            'addressCountry' => 'GB',
        ],
        'areaServed' => array_merge(
            [['@type' => 'AdministrativeArea', 'name' => 'East Midlands']],
            array_map(static fn ($t) => ['@type' => 'City', 'name' => $t], cfg('towns'))
        ),
        'founder' => ['@id' => abs_url('/about/#rich')],
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'telephone' => cfg('phone_e164'),
            'email' => cfg('email'),
            'contactType' => 'customer support',
            'areaServed' => 'GB',
            'availableLanguage' => 'en-GB',
        ],
        'knowsAbout' => ['Website hosting', 'WordPress hosting', 'Website migration', 'SSL certificates', 'Website backups', 'Domain names'],
    ],
    [
        '@type' => 'WebSite',
        '@id' => abs_url('/#website'),
        'url' => abs_url('/'),
        'name' => cfg('name'),
        'inLanguage' => 'en-GB',
        'publisher' => ['@id' => $org_id],
    ],
    [
        '@type' => $page['schema_type'] ?? 'WebPage',
        '@id' => abs_url($page['path']) . '#webpage',
        'url' => abs_url($page['path']),
        'name' => $page['title'],
        'description' => $page['description'],
        'isPartOf' => ['@id' => abs_url('/#website')],
        'about' => ['@id' => $org_id],
        'inLanguage' => 'en-GB',
    ],
];

if ($page['path'] !== '/') {
    $graph[] = [
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => abs_url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => $page['crumb'] ?? $page['title'], 'item' => abs_url($page['path'])],
        ],
    ];
}

foreach ($page['schema'] ?? [] as $node) {
    $graph[] = $node;
}
?>
<script type="application/ld+json"><?= json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?></script>
