<?php
/**
 * FAQ sets. Used for the on-page lists and FAQPage schema.
 * Answers may contain simple HTML (links). Keep them plain English, first person.
 */
defined('SK_APP') || exit;

return [
    'home' => [
        'domain-and-email' => [
            'q' => 'Do I have to move my domain or email to you?',
            'a' => 'No. You keep your domain where it is, and your email stays put unless you ask me to move it. I only change the settings that point your website at my server. I never recommend moving a domain provider unless it saves you money.',
        ],
        'downtime' => [
            'q' => 'Will my website go offline while you move it?',
            'a' => 'I copy your site to my server and test it privately first, while your current site keeps running. Then I switch over at a quiet time. Most moves go unnoticed by your visitors. I won\'t promise zero downtime, because nobody honestly can, but I plan for none.',
        ],
        'first-time' => [
            'q' => 'I\'ve never had website hosting before. Can you help?',
            'a' => 'Yes. I\'ll set up your hosting, SSL certificate and email, and help you pick and register a domain if you don\'t have one. I explain each part in plain English as I go, so you know what you own and what you pay for.',
        ],
        'something-breaks' => [
            'q' => 'What happens if something goes wrong with my website?',
            'a' => 'You call or message me. I keep a daily backup of your site off the server, so I can roll it back to yesterday if needed. Problems on my side, like the server or SSL, I fix at no charge. Changes or fixes to your site itself cost £65 an hour, and I tell you the cost before I start.',
        ],
        'leaving' => [
            'q' => 'What if I want to leave?',
            'a' => 'If you\'re unhappy in the first 30 days, I refund your hosting fee in full. After that, give me one month\'s notice and I refund the unused full months. Either way, you get a full backup of your website to take with you, free.',
        ],
        'full-price' => [
            'q' => 'Is £119 a year the full price?',
            'a' => 'Yes. There\'s no VAT to add, no SSL fee and no domain protection charge. It renews at £119 unless I write to you at least 30 days before any change. The only extras are domain registration, if you register a domain with me, and paid changes you ask for.',
        ],
    ],

    'pricing' => [
        'billing' => [
            'q' => 'How does billing work?',
            'a' => 'Hosting is billed once a year, in advance. You get an invoice that names your website, and the price shown is the price you pay. I\'m not VAT registered, so there\'s nothing to add.',
        ],
        'standard-or-managed' => [
            'q' => 'Should I pick Standard or Managed?',
            'a' => 'Pick Standard if you, or someone you work with, keeps your WordPress plugins and themes updated, or if your site isn\'t WordPress. Pick Managed if you\'d rather not think about updates at all. Both get the same server, backups, SSL and support.',
        ],
        'migration-scope' => [
            'q' => 'What does free migration include?',
            'a' => 'Moving one website per plan: WordPress or a standard PHP or HTML site, with its files and database. I copy it, test it privately, switch the settings over and check everything works, email included. It doesn\'t cover bespoke applications, fixing a broken site before it can move, premium plugin licences or redesigns. I quote those up front at £65 an hour.',
        ],
        'ssl-fees' => [
            'q' => 'Why do other hosts charge for SSL?',
            'a' => 'Some providers sell SSL certificates and "domain protection" as yearly add-ons, often £79 or more. Free, trusted SSL certificates have been available for years. I include one with every site and renew it automatically, so you never see a separate charge.',
        ],
        'domain-prices' => [
            'q' => 'How much are domains?',
            'a' => 'If you register a domain with me, a .co.uk or .uk costs £14 a year and a .com costs £22 a year. If you already own a domain elsewhere, you can keep it there and pay nothing extra to me.',
        ],
        'money-back' => [
            'q' => 'Is there a money-back guarantee?',
            'a' => 'Yes. If you\'re not happy in the first 30 days of a new plan, I refund the hosting fee in full. Domain fees can\'t be refunded, but the domain stays yours. After 30 days, one month\'s notice gets you a refund of the unused full months.',
        ],
    ],
];
