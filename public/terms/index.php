<?php
require __DIR__ . '/../../app/bootstrap.php';

$page = [
    'id' => 'terms',
    'path' => '/terms/',
    'crumb' => 'Hosting terms',
    'title' => 'Hosting Terms in Plain English | Studio Key',
    'description' => 'Studio Key hosting terms: yearly billing, 30-day money-back, cancellation, free migration scope and who looks after what.',
];
$updated = '28&nbsp;October&nbsp;2026';
include APP . '/partials/head.php';
include APP . '/partials/header.php';
?>
<main id="main">
<section class="page-hero section--dark" data-section="terms-hero" aria-labelledby="terms-title">
  <div class="container">
    <p class="eyebrow"><?= icon('scales') ?> Legal</p>
    <h1 class="h1" id="terms-title">Hosting terms, in plain English</h1>
    <p class="lead">The agreement between you and <?= e(cfg('legal_name')) ?>, trading as Studio Key. Last updated <?= $updated ?>.</p>
  </div>
</section>

<section class="section section--legal" data-section="terms">
  <div class="container legal"><?php ob_start(); ?><div class="prose">
    <h2>1. What you get</h2>
    <p>Hosting for one website on a private server managed by me, with a free SSL certificate, daily backups to Amazon Web Services, uptime monitoring and direct support from me. The Managed plan adds WordPress core, plugin and theme updates. The <a href="/pricing/#who-does-what">who looks after what</a> table is part of these terms.</p>

    <h2>2. Prices and billing</h2>
    <ul>
      <li>Standard is <?= money(cfg('plans')['standard']['price']) ?> a year. Managed is <?= money(cfg('plans')['managed']['price']) ?> a year.</li>
      <li>Hosting is billed yearly, in advance. Each invoice names the website it covers.</li>
      <li>I'm not VAT registered, so there's no VAT to add.</li>
      <li>Your plan renews at the same price. If I ever need to change it, I'll write to you at least 30 days before your renewal.</li>
      <li>Domains registered with me cost <?= money(cfg('domains')['.co.uk / .uk']) ?> a year (.co.uk or .uk) or <?= money(cfg('domains')['.com']) ?> a year (.com).</li>
      <li>Changes or fixes to your website cost <?= money(cfg('hourly')) ?> an hour. I tell you the cost before I start.</li>
    </ul>

    <h2>3. Moving your website to me</h2>
    <p>Migration of one website per plan is free. It covers WordPress or a standard PHP/HTML website with its files and database, private testing, switching over and checking your email still works. It doesn't cover bespoke applications, fixing a broken or badly out-of-date site before it can move, premium licence costs or redesigns. I quote those first.</p>

    <h2>4. Money-back guarantee</h2>
    <p>If you're not happy within 30 days of starting a new hosting plan, tell me and I'll refund the hosting fee in full. Domain registration fees can't be refunded, but the domain stays yours.</p>

    <h2>5. Leaving</h2>
    <p>You can leave at any time by giving one month's notice by email. I refund the unused full months of your yearly hosting fee. Before your hosting ends, I'll give you a full backup of your website and help your new host get set up.</p>

    <h2>6. Your website and your data</h2>
    <p>Your website, content and data belong to you. I only access them to host, back up, secure and support your site, or when you ask me to.</p>

    <h2>7. Fair use</h2>
    <p>Please don't use the hosting for anything illegal, for sending spam, or for anything that harms the server or other clients' websites. If that happens, I'll contact you first and may suspend the site to protect everyone else.</p>

    <h2>8. If something goes wrong</h2>
    <p>I work hard to keep your website online and safe, but no host can promise 100% uptime. If a problem on my side affects your site, I'll fix it as quickly as I can at no cost. My liability to you is limited to the hosting fees you paid in the 12 months before the problem. This doesn't affect any rights you have by law.</p>

    <h2>9. Unpaid invoices</h2>
    <p>If an invoice goes unpaid, I'll remind you and talk to you before anything is switched off.</p>

    <h2>10. The legal bit</h2>
    <p>These terms are governed by the law of England and Wales. Questions? Email <a href="mailto:<?= e(cfg('email')) ?>"><?= e(cfg('email')) ?></a> or call <?= e(cfg('phone_display')) ?>.</p>
  </div><?= legal_with_toc((string) ob_get_clean()) ?></div>
</section>
</main>
<?php include APP . '/partials/footer.php'; ?>
