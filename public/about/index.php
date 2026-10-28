<?php
require __DIR__ . '/../../app/bootstrap.php';

$page = [
    'id' => 'about',
    'path' => '/about/',
    'crumb' => 'About',
    'title' => 'About Rich, Your Local Website Host | Studio Key',
    'description' => 'I\'m Rich, an independent hosting provider in Corby looking after 110+ business websites across the East Midlands.',
    'schema_type' => 'AboutPage',
    'schema' => [[
        '@type' => 'Person',
        '@id' => abs_url('/about/#rich'),
        'name' => 'Rich',
        'jobTitle' => 'Independent website hosting provider',
        'worksFor' => ['@id' => abs_url('/#organisation')],
        'homeLocation' => ['@type' => 'Place', 'name' => 'Corby, Northamptonshire'],
        'knowsAbout' => ['Website hosting', 'WordPress', 'Website migration', 'Web design'],
    ]],
];
include APP . '/partials/head.php';
include APP . '/partials/header.php';
?>
<main id="main">

<section class="page-hero section--dark ambient" data-section="about-hero" aria-labelledby="about-title">
  <div class="container about-hero">
    <div class="about-hero__copy">
      <p class="eyebrow"><?= icon('hand-waving') ?> About me</p>
      <h1 class="h1" id="about-title">Hello, I'm Rich. I look after your website so you don't have to.</h1>
      <p class="lead">I'm an independent website hosting provider in Corby. I host <?= e(cfg('sites_count')) ?> business websites across the East Midlands, and every one of those businesses has my phone number.</p>
      <div class="hero__actions">
        <a class="btn btn--primary btn--lg" href="/contact/" data-cta="about-primary"><?= e(cfg('cta_primary')) ?> <?= icon('arrow-right') ?></a>
        <a class="link-quiet link-quiet--light" href="/pricing/" data-cta="about-pricing">See my prices <?= icon('arrow-right') ?></a>
      </div>
    </div>
    <div class="about-hero__photo">
      <div class="photo-placeholder glass" role="img" aria-label="Photo of Rich coming soon">
        <?= icon('user-circle') ?>
        <span>Photo of Rich coming soon</span>
      </div>
    </div>
  </div>
</section>

<section class="section" data-section="story" aria-labelledby="story-title">
  <div class="container split">
    <div class="split__main prose">
      <h2 class="h2" id="story-title">Why I do hosting this way</h2>
      <p class="prose-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla.</p>
      <p>Cras mattis consectetur purus sit amet fermentum. Maecenas faucibus mollis interdum. Vestibulum id ligula porta felis euismod semper. Nullam quis risus eget urna mollis ornare vel eu leo.</p>
      <p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Curabitur blandit tempus porttitor. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
    </div>
    <aside class="split__side" data-section="also" aria-labelledby="also-title">
      <h2 class="h3" id="also-title">I also build websites</h2>
      <p class="lead--dark">Hosting is what I do most, but I also design, build and look after websites for local businesses. If your site needs more than a new home, I can help with that too.</p>
      <p><a class="link-quiet" href="/contact/?need=new#enquiry" data-cta="about-build">Talk to me about a new website <?= icon('arrow-right') ?></a></p>
    </aside>
  </div>
</section>

<section class="section section--paper" data-section="how-i-work" aria-labelledby="work-title">
  <div class="container">
    <header class="section-head">
      <h2 class="h2" id="work-title">How I work</h2>
      <p class="lead lead--dark">The same way I'd want my own website looked after.</p>
    </header>
    <ul class="values">
      <li>
        <span class="promise__icon"><?= icon('handshake') ?></span>
        <div><h3 class="h4">In person or on a call</h3><p>Local clients can meet me face to face to get set up. Everyone else, a phone, Teams or Zoom call works just as well.</p></div>
      </li>
      <li>
        <span class="promise__icon"><?= icon('test-tube') ?></span>
        <div><h3 class="h4">Test first, switch second</h3><p>I test every website on my server before anything changes, so your visitors and your email carry on as normal.</p></div>
      </li>
      <li>
        <span class="promise__icon"><?= icon('chat-circle-text') ?></span>
        <div><h3 class="h4">Same-day replies</h3><p>Most messages get an answer the same day. You deal with me every time, so you never explain your setup twice.</p></div>
      </li>
      <li>
        <span class="promise__icon"><?= icon('scales') ?></span>
        <div><h3 class="h4">Honest advice</h3><p>If moving won't save you money or hassle, I'll tell you to stay put. I never recommend moving a domain provider unless it saves you money.</p></div>
      </li>
    </ul>
  </div>
</section>

<section class="section" data-section="areas" aria-labelledby="areas-title">
  <div class="container">
    <header class="section-head">
      <h2 class="h2" id="areas-title">Website hosting across the East Midlands</h2>
      <p class="lead lead--dark">I'm based in Corby and look after businesses across Northamptonshire and the surrounding counties. Further afield? Happy to help over the phone.</p>
    </header>
    <ul class="towns">
      <?php foreach (cfg('towns') as $town): ?>
        <li><?= icon('map-pin') ?> <?= e($town) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<?php include APP . '/partials/cta-band.php'; ?>

</main>
<?php include APP . '/partials/footer.php'; ?>
