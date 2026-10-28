<?php
/**
 * Lead delivery. Brevo when configured, PHP mail() otherwise.
 * Returns true when at least Rich's notification went out.
 */
defined('SK_APP') || exit;

function brevo_request(string $path, array $body): bool
{
    $key = (string) secret('brevo_api_key', '');
    if ($key === '' || !function_exists('curl_init')) {
        return false;
    }
    $ch = curl_init('https://api.brevo.com/v3' . $path);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 5,
        CURLOPT_CONNECTTIMEOUT => 3,
        CURLOPT_HTTPHEADER => ['accept: application/json', 'content-type: application/json', 'api-key: ' . $key],
        CURLOPT_POSTFIELDS => json_encode($body, JSON_UNESCAPED_UNICODE),
    ]);
    $res = curl_exec($ch);
    $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($res === false || $code >= 300) {
        error_log('[studio-key] Brevo ' . $path . ' failed with HTTP ' . $code);
        return false;
    }
    return true;
}

function deliver_lead(array $d): bool
{
    $summary = form_summary($d);
    $first = explode(' ', $d['name'])[0] ?: 'there';

    if ((string) secret('brevo_api_key', '') !== '') {
        $lists = array_filter([(int) secret('brevo_list_id', 0), $d['tips'] ? (int) secret('brevo_news_list_id', 0) : 0]);
        brevo_request('/contacts', [
            'email' => $d['email'],
            'updateEnabled' => true,
            'listIds' => array_values($lists),
            'attributes' => array_filter([
                'FIRSTNAME' => $first,
                'SMS' => $d['phone'] ?: null,
                'NEED' => $d['need'],
                'WEBSITE' => $d['website'] ?: null,
                'CURRENT_HOST' => $d['host'] ?: null,
                'REPLY_BY' => $d['reply'],
                'UTM_CAMPAIGN' => $d['utm']['campaign'] ?? null,
                'UTM_SOURCE' => $d['utm']['source'] ?? null,
            ]),
        ]);
        $sender = ['email' => secret('brevo_sender_email'), 'name' => secret('brevo_sender_name')];
        $sent = brevo_request('/smtp/email', [
            'sender' => $sender,
            'to' => [['email' => secret('notify_email')]],
            'replyTo' => ['email' => $d['email'], 'name' => $d['name']],
            'subject' => 'New website enquiry: ' . $d['name'],
            'textContent' => $summary,
        ]);
        brevo_request('/smtp/email', [
            'sender' => $sender,
            'to' => [['email' => $d['email'], 'name' => $d['name']]],
            'subject' => 'Thanks, I\'ve got your message',
            'textContent' => confirmation_text($first, $d),
        ]);
        if ($sent) {
            return true;
        }
    }

    // Fallback: plain mail() to Rich. Headers are fixed strings, user input only goes in the body.
    $to = (string) secret('notify_email', cfg('email'));
    $headers = "From: Studio Key website <" . cfg('email') . ">\r\nContent-Type: text/plain; charset=UTF-8";
    $ok = function_exists('mail') && @mail($to, 'New website enquiry', $summary, $headers);
    if (!$ok) {
        error_log('[studio-key] mail() fallback failed');
    }
    return $ok;
}

function confirmation_text(string $first, array $d): string
{
    $how = match ($d['reply']) {
        'call' => 'I\'ll give you a ring on ' . $d['phone'],
        'whatsapp' => 'I\'ll message you on WhatsApp',
        default => 'I\'ll reply by email',
    };
    return "Hi {$first},\n\nThanks for getting in touch. {$how} today or the next working day.\n\n"
        . "If it's urgent, call me on " . cfg('phone_display') . ".\n\nSpeak soon,\nRich\nStudio Key\n" . cfg('url');
}
