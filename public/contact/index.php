<?php
require __DIR__ . '/../../app/bootstrap.php';

$page = [
    'id' => 'contact',
    'path' => '/contact/',
    'crumb' => 'Contact',
    'title' => 'Contact Rich in Corby | Studio Key',
    'description' => 'Call, WhatsApp or send a message. I reply the same day or the next working day. Based in Corby, serving the East Midlands.',
    'schema_type' => 'ContactPage',
    'scripts' => ['form.js'],
];
include APP . '/partials/head.php';
include APP . '/partials/header.php';
?>
<main id="main">

<section class="page-hero section--dark ambient" id="enquiry" data-section="enquiry" aria-labelledby="contact-title">
  <div class="container enquiry-wrap">
    <div class="enquiry-wrap__intro">
      <h1 class="h1" id="contact-title">Let's see what would work for you</h1>
      <p class="lead">Moving a website, starting from scratch, or want a second opinion on what you pay now? Tell me a little and I'll reply today or the next working day.</p>
    </div>
    <div class="enquiry-wrap__form glass">
      <?php include APP . '/partials/enquiry-form.php'; ?>
    </div>
    <div class="enquiry-wrap__more">
      <div class="person">
        <span><strong>Rich</strong><span><?= e(cfg('hours')) ?></span></span>
      </div>
      <?php $quote = 'timothy-lyons'; include APP . '/partials/quote.php'; ?>
      <ul class="contact-list">
        <li><a href="tel:<?= e(cfg('phone_e164')) ?>" data-contact="phone" data-cta="contact-call"><?= icon('phone') ?> <?= e(cfg('phone_display')) ?></a></li>
        <li><a href="<?= e(cfg('whatsapp')) ?>" rel="noopener" target="_blank" data-contact="whatsapp" data-cta="contact-whatsapp"><?= icon('brand-whatsapp') ?> WhatsApp me</a></li>
        <li><a href="mailto:<?= e(cfg('email')) ?>" data-contact="email" data-cta="contact-email"><?= icon('envelope-simple') ?> <?= e(cfg('email')) ?></a></li>
        <li class="contact-list__area"><?= icon('map-pin') ?> <?= e(cfg('area_line')) ?></li>
      </ul>
    </div>
  </div>
</section>

<section class="section" data-section="next-steps" aria-labelledby="next-title">
  <div class="container">
    <header class="section-head">
      <h2 class="h2" id="next-title">What happens after you get in touch</h2>
    </header>
    <ol class="next-steps">
      <li><h3 class="h4">I reply</h3><p>The same day or the next working day, by email, phone or WhatsApp, whichever you picked.</p></li>
      <li><h3 class="h4">A quick chat</h3><p>Ten or fifteen minutes to understand your website, email and domain. No sales script.</p></li>
      <li><h3 class="h4">You get a clear answer</h3><p>What I'd do, what it costs and when. If you're better off where you are, I'll tell you.</p></li>
    </ol>
  </div>
</section>

</main>
<?php include APP . '/partials/footer.php'; ?>
