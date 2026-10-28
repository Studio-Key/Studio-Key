<?php
/**
 * Site-wide settings. Anything that appears in more than one place lives here.
 * Change a price, phone number or CTA label once and every page follows.
 */
defined('SK_APP') || exit;

return [
    // 'live' or 'dev'. Dev sends noindex headers. Override with the SK_ENV server variable.
    'env' => getenv('SK_ENV') ?: 'live',

    'url'        => 'https://www.studio-key.co.uk',
    'name'       => 'Studio Key',
    'legal_name' => 'RMD Trading Limited',
    'company_no' => '11656826',
    'office'     => '44 Furlong Close, Weldon, NN17 5AW',
    'person'     => 'Rich',
    'locality'   => 'Corby',
    'region'     => 'Northamptonshire',
    'area_line'  => 'Based in Corby, serving the East Midlands',

    'phone_display' => '07356 171658',
    'phone_e164'    => '+447356171658',
    'whatsapp'      => 'https://wa.me/447356171658',
    'email'         => 'help@studio-key.co.uk',
    'sites_count'   => '110+',
    'hours'         => 'Monday to Friday, 9am to 5pm',

    'towns' => ['Corby', 'Kettering', 'Wellingborough', 'Northampton', 'Market Harborough', 'Oakham', 'Stamford', 'Leicester', 'Peterborough'],

    // Primary CTA label. Swap here to A/B test (PRD 9.1).
    'cta_primary' => 'See your options',

    'plans' => [
        'standard' => [
            'name'     => 'Standard',
            'price'    => 119,
            'monthly'  => 'under £10 a month',
            'tag'      => 'Most businesses',
            'summary'  => 'Everything a small business website needs, looked after by me.',
            'features' => [
                'Free SSL certificate for life',
                'Daily backups to Amazon AWS S3',
                'Uptime monitoring',
                'Security patching and firewall',
                'Free migration of one website',
                'Direct support from me',
                'No domain protection fees',
            ],
        ],
        'managed' => [
            'name'     => 'Managed',
            'price'    => 450,
            'monthly'  => '£37.50 a month',
            'tag'      => 'Hands-off',
            'summary'  => 'Everything in Standard, and I keep your WordPress site up to date for you.',
            'lead'     => 'Everything in Standard, plus:',
            'fit'      => 'Best if you\'d rather never think about updates.',
            'features' => [
                'WordPress core updates',
                'Plugin and theme updates',
                'Update checks so nothing breaks quietly',
                'Free migration of one website',
            ],
        ],
    ],
    'domains' => ['.co.uk / .uk' => 14, '.com' => 22],
    'hourly'  => 65,

    // Analytics. Empty means GA4 never loads.
    'ga4_id'        => '',
    // First-party event collector URL for the future dashboard. Empty means events stay in dataLayer.
    'collector_url' => '',

    'nav' => [
        '/pricing/' => 'Pricing',
        '/about/'   => 'About',
        '/contact/' => 'Contact',
    ],

    // Public Google reviews link. Empty hides the "See all reviews" link.
    'reviews_url' => '',
    'green_check_url' => 'https://www.thegreenwebfoundation.org/green-web-check/?url=www.studio-key.co.uk',

    // Bump when CSS or JS changes so browsers fetch the new file.
    'asset_version' => '1',
];
