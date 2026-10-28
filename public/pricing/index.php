<?php
require __DIR__ . '/../../app/bootstrap.php';
$faqs_all = require APP . '/content/faqs.php';
$faqs = $faqs_all['pricing'];
$plans = cfg('plans');

$offer = static fn (array $p) => [
    '@type' => 'Offer',
    'name' => $p['name'] . ' hosting',
    'price' => (string) $p['price'],
    'priceCurrency' => 'GBP',
    'priceSpecification' => ['@type' => 'UnitPriceSpecification', 'price' => (string) $p['price'], 'priceCurrency' => 'GBP', 'unitText' => 'YEAR', 'valueAddedTaxIncluded' => false],
    'availability' => 'https://schema.org/InStock',
    'url' => abs_url('/pricing/'),
    'seller' => ['@id' => abs_url('/#organisation')],
];

$page = [
    'id' => 'pricing',
    'path' => '/pricing/',
    'crumb' => 'Pricing',
    'title' => 'Website Hosting Prices, £119 a Year | Studio Key',
    'description' => 'One clear yearly price. Free SSL, daily backups and free migration included. No VAT, no domain protection fees, no surprises.',
    'schema' => [
        [
            '@type' => 'Service',
            'name' => 'Website hosting',
            'serviceType' => 'Website hosting',
            'provider' => ['@id' => abs_url('/#organisation')],
            'areaServed' => 'East Midlands, United Kingdom',
            'offers' => [$offer($plans['standard']), $offer($plans['managed'])],
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(static fn ($f) => [
                '@type' => 'Question', 'name' => $f['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
            ], array_values($faqs)),
        ],
    ],
];

$duties = [
    ['Server, security patching and firewall', 'me', 'me'],
    ['SSL certificate and renewals', 'me', 'me'],
    ['Daily backups to AWS S3, and restores', 'me', 'me'],
    ['Uptime monitoring', 'me', 'me'],
    ['WordPress core, plugin and theme updates', 'you', 'me'],
    ['Content changes to your website', 'you', 'you'],
    ['Domain renewal, if registered with me', 'me', 'me'],
];
$cell = static fn (string $who) => $who === 'me'
    ? '<span class="yes">' . icon('check-circle') . ' <span class="duty-me">Me</span></span>'
    : '<span class="duty-long">You, or me at ' . money(cfg('hourly')) . '/hr</span><span class="duty-short">You or ' . money(cfg('hourly')) . '/hr</span>';

include APP . '/partials/head.php';
include APP . '/partials/header.php';
?>
<main id="main">

<section class="page-hero page-hero--tight section--dark ambient" data-section="pricing-hero" aria-labelledby="pricing-title">
  <div class="container">
    <h1 class="h1" id="pricing-title">The price you see is the price you pay</h1>
    <p class="lead">From <strong class="text-white">£119 a year, all in</strong>. One bill a year. No VAT, no SSL fees and no domain protection charges. If a price ever changes, I'll tell you in writing 30 days before.</p>
  </div>
</section>

<section class="section section--pull" data-section="plans" aria-labelledby="plans-title">
  <div class="container">
    <h2 class="sr-only" id="plans-title">Hosting plans</h2>
    <div class="plans">
      <?php foreach ($plans as $key => $p): ?>
        <article class="plan<?= $key === 'standard' ? ' plan--featured' : '' ?>" aria-labelledby="plan-<?= e($key) ?>">
          <span class="plan__tag"><?= e($p['tag']) ?></span>
          <h3 class="plan__name" id="plan-<?= e($key) ?>"><?= e($p['name']) ?></h3>
          <p class="plan__summary"><?= e($p['summary']) ?></p>
          <p class="price"><span class="price__amount"><?= money($p['price']) ?></span><span class="price__per">a year</span></p>
          <p class="price__sub">That's <?= e($p['monthly']) ?>. Billed yearly in advance. Renews at <?= money($p['price']) ?>.</p>
          <div class="plan__list">
            <?php if (!empty($p['lead'])): ?><p class="plan__lead"><?= e($p['lead']) ?></p><?php endif; ?>
            <ul class="ticks">
              <?php foreach ($p['features'] as $f): ?>
                <li><?= icon('check') ?> <?= e($f) ?></li>
              <?php endforeach; ?>
            </ul>
            <?php if (!empty($p['fit'])): ?><p class="plan__fit"><?= icon('lightbulb') ?> <?= e($p['fit']) ?></p><?php endif; ?>
          </div>
          <a class="btn <?= $key === 'standard' ? 'btn--primary' : 'btn--ghost' ?> btn--block" href="/contact/?plan=<?= e($key) ?>#enquiry" data-cta="plan-<?= e($key) ?>">Choose <?= e($p['name']) ?> <?= icon('arrow-right') ?></a>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="plans-proof">
      <?php $quote = 'ryan-young'; include APP . '/partials/quote.php'; ?>
      <?php $quote = 'tejal-prajapati'; include APP . '/partials/quote.php'; ?>
    </div>

    <div class="extras">
      <div class="extra">
        <p class="extra__label"><?= icon('globe-simple') ?> Domain names</p>
        <p class="extra__price"><?= money(cfg('domains')['.co.uk / .uk']) ?> <span class="opt-dark">.co.uk a year</span></p>
        <p><?= money(cfg('domains')['.com']) ?> a year for a .com. Only if you register one with me. Already own one? Keep it where it is.</p>
      </div>
      <div class="extra">
        <p class="extra__label"><?= icon('wrench') ?> Changes and fixes</p>
        <p class="extra__price"><?= money(cfg('hourly')) ?> <span class="opt-dark">an hour</span></p>
        <p>For changes to your website itself. I tell you the cost before I start, so there are no surprises.</p>
      </div>
      <div class="extra">
        <p class="extra__label"><?= icon('truck') ?> Moving your website</p>
        <p class="extra__price">Free</p>
        <p>One website per plan, files, database and all. <a href="#migration">What's included</a>.</p>
      </div>
    </div>
  </div>
</section>

<section class="section section--paper" id="who-does-what" data-section="included" aria-labelledby="duties-title">
  <div class="container">
    <header class="section-head">
      <h2 class="h2" id="duties-title">Who looks after what</h2>
      <p class="lead lead--dark">So you always know who's doing what. If it's my job, it's in the price.</p>
    </header>
    <div class="table-wrap" role="region" aria-labelledby="duties-title" tabindex="0">
      <table class="duties">
        <thead><tr><th scope="col">Task</th><th scope="col">Standard</th><th scope="col">Managed</th></tr></thead>
        <tbody>
          <?php foreach ($duties as [$task, $std, $man]): ?>
            <tr><th scope="row"><?= e($task) ?></th><td data-label="Standard"><?= $cell($std) ?></td><td data-label="Managed"><?= $cell($man) ?></td></tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section class="section" data-section="terms" aria-labelledby="terms-title">
  <div class="container">
    <header class="section-head">
      <h2 class="h2" id="terms-title">The terms, in plain English</h2>
      <p class="lead lead--dark">The short version. The full details are on my <a href="/terms/">hosting terms</a> page.</p>
    </header>
    <div class="terms-grid">
      <div class="term" id="migration">
        <h3 class="h4"><?= icon('truck') ?> Free migration covers</h3>
        <ul>
          <li>One WordPress or standard PHP/HTML website per plan, with its files and database</li>
          <li>Copying, private testing, switching over and checking it all works</li>
          <li>Making sure your email keeps running</li>
        </ul>
        <p>Not covered, and quoted up front at <?= money(cfg('hourly')) ?> an hour: bespoke applications, fixing a broken site before it can move, premium plugin licences and redesigns.</p>
      </div>
      <div class="term">
        <h3 class="h4"><?= icon('arrow-counter-clockwise') ?> 30-day money-back</h3>
        <p>Not happy in the first 30 days of a new plan? I refund the hosting fee in full. Domain fees can't be refunded, and the domain stays yours.</p>
      </div>
      <div class="term">
        <h3 class="h4"><?= icon('door-open') ?> Leaving</h3>
        <p>Give me one month's notice at any time. I refund the unused full months of your yearly fee and give you a full backup of your website, free.</p>
      </div>
      <div class="term">
        <h3 class="h4"><?= icon('clock-countdown') ?> Downtime</h3>
        <p>I test your site on my server before anything switches, and I make the switch at a quiet time. Most moves go unnoticed. To be fully transparent, nobody can promise zero downtime.</p>
      </div>
    </div>
  </div>
</section>

<section class="section section--paper" data-section="faq" aria-labelledby="pfaq-title">
  <div class="container split split--faq">
    <header class="split__side">
      <h2 class="h2" id="pfaq-title">Pricing questions</h2>
      <p class="lead lead--dark">Anything I haven't covered? <a href="tel:<?= e(cfg('phone_e164')) ?>" data-contact="phone">Call me</a> and ask.</p>
      <div class="mini-person">
        <span><strong>Ask me directly</strong><span>Usually a same-day reply</span></span>
        <a class="btn btn--ghost btn--sm" href="tel:<?= e(cfg('phone_e164')) ?>" data-contact="phone" data-cta="faq-call"><?= icon('phone') ?> <?= e(cfg('phone_display')) ?></a>
      </div>
    </header>
    <div class="split__main">
      <?php include APP . '/partials/faq.php'; ?>
    </div>
  </div>
</section>

<?php $cta_title = 'Not sure which plan fits?'; $cta_text = 'Tell me about your website and I\'ll recommend one. If you\'d be better off staying where you are, I\'ll say so.'; include APP . '/partials/cta-band.php'; ?>

</main>
<?php include APP . '/partials/footer.php'; ?>
