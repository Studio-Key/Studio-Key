<?php
/**
 * Copy to app/secrets.php on the server and fill in. Never commit secrets.php.
 * chmod 600 app/secrets.php
 */
defined('SK_APP') || exit;

return [
    // Long random string. Signs form tokens and hashes IPs. Generate with: php -r "echo bin2hex(random_bytes(32));"
    'app_key' => '',

    // Brevo (parked until set). Leave blank and enquiries go by PHP mail() plus the private lead log.
    'brevo_api_key'      => '',
    'brevo_list_id'      => 0,  // "Website enquiries" list
    'brevo_news_list_id' => 0,  // Only for people who tick the tips box
    'brevo_sender_email' => 'help@studio-key.co.uk',
    'brevo_sender_name'  => 'Rich at Studio Key',

    // Where enquiry notifications go.
    'notify_email' => 'help@studio-key.co.uk',
];
