<?php
require __DIR__ . '/../../app/bootstrap.php';

$page = [
    'id' => 'privacy',
    'path' => '/privacy/',
    'crumb' => 'Privacy and cookies',
    'title' => 'Privacy and Cookies | Studio Key',
    'description' => 'How Studio Key collects, uses and protects your personal data, which cookies the site uses and how to exercise your rights.',
];
$updated = '28 October 2026';
include APP . '/partials/head.php';
include APP . '/partials/header.php';
?>
<main id="main">
<section class="page-hero section--dark" data-section="privacy-hero" aria-labelledby="privacy-title">
  <div class="container">
    <h1 class="h1" id="privacy-title">Privacy and cookies</h1>
    <p class="lead">What I collect, why, who else sees it, and how to ask me to delete it. Last updated <?= e($updated) ?>.</p>
  </div>
</section>

<section class="section" data-section="privacy">
  <div class="container prose">
    <h2>Who I am</h2>
    <p>This website is run by <?= e(cfg('legal_name')) ?>, trading as Studio Key (company no. <?= e(cfg('company_no')) ?>), registered office <?= e(cfg('office')) ?>. I'm the data controller for the personal data described here. You can reach me at <a href="mailto:<?= e(cfg('email')) ?>"><?= e(cfg('email')) ?></a> or on <?= e(cfg('phone_display')) ?>.</p>

    <h2>What I collect and why</h2>
    <table>
      <thead><tr><th scope="col">What</th><th scope="col">Why</th><th scope="col">Lawful basis</th></tr></thead>
      <tbody>
        <tr><td>What you enter in the enquiry form: name, email, phone (optional), your website, current host, what you need and your message</td><td>To reply to you and give you a quote</td><td>Steps you ask me to take before a contract, and my legitimate interest in answering enquiries</td></tr>
        <tr><td>Which page you sent the form from, the page you first landed on, the site that sent you and any campaign tags in the link</td><td>To know which of my emails and pages help people find me</td><td>Legitimate interest. Stored on your device only if you accept cookies</td></tr>
        <tr><td>Your email address, if you tick the hosting tips box</td><td>To send occasional hosting tips, no more than once a month</td><td>Consent, which you can withdraw any time with the unsubscribe link</td></tr>
        <tr><td>How you use the site: pages viewed, scroll depth, time on page, buttons clicked, form steps</td><td>To improve the site</td><td>Consent, through the cookie banner</td></tr>
        <tr><td>A one-way scrambled version of your IP address, kept for one hour</td><td>To stop spam through the form</td><td>Legitimate interest in keeping the form usable</td></tr>
      </tbody>
    </table>
    <p>If you call, email or WhatsApp me, I keep that conversation so I can help you. WhatsApp is run by Meta under its own privacy policy.</p>

    <h2>Who else handles your data</h2>
    <ul>
      <li><strong>Brevo</strong> (Sendinblue SAS, France): sends and stores my enquiry emails and the hosting tips list.</li>
      <li><strong>Google Analytics</strong> (Google Ireland Ltd and Google LLC): only if you accept cookies. Google may process data in the USA under the UK Extension to the EU-US Data Privacy Framework.</li>
      <li><strong>Hetzner Online</strong> (Germany): hosts this website.</li>
      <li><strong>Cloudflare</strong>: protects and speeds up the website.</li>
    </ul>
    <p>I don't sell your data or share it with anyone else, unless the law requires me to.</p>

    <h2 id="cookies">Cookies and similar storage</h2>
    <p>The site works fully without any optional cookies. Optional ones only load after you click "That's fine" in the banner. You can change your mind any time with <button type="button" class="linklike" data-consent-open>cookie settings</button>.</p>
    <table>
      <thead><tr><th scope="col">Name</th><th scope="col">Type</th><th scope="col">Purpose</th><th scope="col">Lasts</th></tr></thead>
      <tbody>
        <tr><td>sk_consent</td><td>Strictly necessary (local storage)</td><td>Remembers your cookie choice</td><td>Until you clear it</td></tr>
        <tr><td>sk_attr, sk_sid</td><td>Optional (session storage)</td><td>Remembers how you arrived and links page views in one visit</td><td>Until you close the tab</td></tr>
        <tr><td>_ga, _ga_*</td><td>Optional (Google Analytics cookies)</td><td>Counts visits and how people use the site. Only set if I've switched Google Analytics on</td><td>Up to 2 years</td></tr>
      </tbody>
    </table>

    <h2>How long I keep it</h2>
    <ul>
      <li>Enquiries that don't lead to work: up to 2 years, then deleted.</li>
      <li>Client records and invoices: 6 years after you leave, because tax law requires it.</li>
      <li>Hosting tips list: until you unsubscribe.</li>
      <li>Spam-protection data: 1 hour.</li>
    </ul>

    <h2>Your rights</h2>
    <p>You can ask me for a copy of your data, ask me to correct or delete it, object to how I use it, or ask me to stop. Email <a href="mailto:<?= e(cfg('email')) ?>"><?= e(cfg('email')) ?></a> and I'll reply within one month. It's free.</p>
    <p>If you're unhappy with how I've handled your data, you can complain to the Information Commissioner's Office at <a href="https://ico.org.uk/make-a-complaint/" rel="noopener">ico.org.uk</a> or on 0303 123 1113. I'd appreciate the chance to put it right first.</p>

    <h2>Keeping it safe</h2>
    <p>The site uses HTTPS everywhere. Enquiry data travels encrypted and is stored outside the public part of the server. Only I can access it.</p>

    <h2>Changes</h2>
    <p>If I change this notice, I'll update the date at the top.</p>
  </div>
</section>
</main>
<?php include APP . '/partials/footer.php'; ?>
