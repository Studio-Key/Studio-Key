<?php
require __DIR__ . '/../app/bootstrap.php';
$faqs_all = require APP . '/content/faqs.php';
$faqs = $faqs_all['home'];
$std = cfg('plans')['standard'];

$page = [
    'id' => 'home',
    'path' => '/',
    'title' => 'Website Hosting East Midlands, No Hidden Fees | Studio Key',
    'description' => 'Personal website hosting from Rich in Corby. £119 a year with free SSL for life, daily AWS backups and support from a real person.',
    'scripts' => ['form.js'],
    'schema' => [[
        '@type' => 'FAQPage',
        'mainEntity' => array_map(static fn ($f) => [
            '@type' => 'Question', 'name' => $f['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
        ], array_values($faqs)),
    ]],
];
include APP . '/partials/head.php';
include APP . '/partials/header.php';
?>
<main id="main">

<section class="hero section--dark ambient" data-section="hero" aria-labelledby="hero-title">
  <div class="container hero__grid">
    <div class="hero__copy">
      <p class="eyebrow"><?= icon('map-pin') ?> Website hosting in Corby and the East Midlands</p>
      <h1 class="h1" id="hero-title">Personal website hosting, without the hidden costs</h1>
      <p class="lead">I'm Rich, an independent website hosting provider based in the East Midlands. I look after over 110 business websites, providing reliable, affordable hosting with transparent pricing and personal support directly from me.</p>
      <div class="hero__actions">
        <a class="btn btn--primary btn--lg" href="/contact/" data-cta="hero-primary"><?= e(cfg('cta_primary')) ?> <?= icon('arrow-right') ?></a>
        <a class="link-quiet link-quiet--light" href="/pricing/" data-cta="hero-pricing">See my prices <?= icon('arrow-right') ?></a>
      </div>
      <ul class="hero__proof">
        <li><?= icon('tag') ?> <?= money($std['price']) ?> a year, all in</li>
        <li><?= icon('lock-simple') ?> Free SSL for life</li>
        <li><?= icon('truck') ?> Free migration</li>
      </ul>
    </div>
    <div class="hero__media">
      <?php include APP . '/partials/video.php'; ?>
    </div>
  </div>
</section>

<section class="trust-band" data-section="trust" aria-label="Why you can trust this hosting">
  <div class="container">
    <?php include APP . '/partials/trust-logos.php'; ?>
  </div>
</section>

<section class="section" data-section="qualifier" aria-labelledby="qualifier-title">
  <div class="container split">
    <div class="split__main reveal">
      <h2 class="h2" id="qualifier-title">Website hosting you can talk to someone about</h2>
      <p class="prose-lg">If you're happy with a hosting provider that's difficult to contact, charges more than you expected, adds surprise yearly fees and treats you like just another account number, I'm probably not for you.</p>
      <p class="prose-lg">But if you want straightforward, honest website hosting with clear pricing and someone you can speak to directly, without waiting in a support queue, let's talk.</p>
      <div class="inline-actions">
        <a class="btn btn--primary" href="/contact/" data-cta="qualifier-primary"><?= e(cfg('cta_primary')) ?> <?= icon('arrow-right') ?></a>
        <a class="link-quiet" href="/contact/?need=check#enquiry" data-cta="qualifier-check">Get a free hosting check <?= icon('arrow-right') ?></a>
      </div>
    </div>
    <aside class="split__side reveal" data-section="promise" aria-labelledby="promise-title">
      <h2 class="h3" id="promise-title">Helping your business run reliably online</h2>
      <ul class="promise">
        <li>
          <span class="promise__icon"><?= icon('receipt') ?></span>
          <span><strong>No hidden costs</strong><span>One yearly price. What you see is what you pay.</span></span>
        </li>
        <li>
          <span class="promise__icon"><?= icon('lock-key') ?></span>
          <span><strong>Free SSL certificates for life</strong><span>The browser padlock, renewed for you and never billed.</span></span>
        </li>
        <li>
          <span class="promise__icon"><?= icon('cloud-arrow-up') ?></span>
          <span><strong>Daily backups to Amazon AWS S3</strong><span>A fresh copy of your site every day, kept off the server.</span></span>
        </li>
      </ul>
    </aside>
  </div>
</section>

<section class="section section--dark ambient ambient--alt" data-section="problems" aria-labelledby="problems-title">
  <div class="container">
    <header class="section-head section-head--center">
      <p class="eyebrow">Why people move to me</p>
      <h2 class="h2">Hosting shouldn't come with surprises</h2>
    </header>
    <div class="compare">
      <div class="compare__col glass reveal">
        <h2 class="h3" id="problems-title">Sound familiar?</h2>
        <ul class="icon-list">
          <li><span class="li-icon li-icon--pain"><?= icon('currency-gbp') ?></span> Unexpected £79+ yearly SSL and domain protection fees</li>
          <li><span class="li-icon li-icon--pain"><?= icon('currency-gbp') ?></span> Paying more than you should for hosting</li>
          <li><span class="li-icon li-icon--pain"><?= icon('x-circle') ?></span> Confusing website management and unclear charges</li>
          <li><span class="li-icon li-icon--pain"><?= icon('x-circle') ?></span> Feeling like you have no ownership of your website</li>
          <li><span class="li-icon li-icon--warn"><?= icon('warning') ?></span> Unreliable or missing backups</li>
          <li><span class="li-icon li-icon--warn"><?= icon('warning') ?></span> Slow, impersonal customer support</li>
        </ul>
      </div>
      <div class="compare__col compare__col--good glass reveal" data-section="solutions">
        <h2 class="h3">A more straightforward approach</h2>
        <ul class="icon-list">
          <li><span class="li-icon li-icon--good"><?= icon('check-circle') ?></span> Transparent, predictable pricing</li>
          <li><span class="li-icon li-icon--good"><?= icon('check-circle') ?></span> Free SSL certificates for life</li>
          <li><span class="li-icon li-icon--good"><?= icon('check-circle') ?></span> Complete ownership of your website</li>
          <li><span class="li-icon li-icon--good"><?= icon('check-circle') ?></span> Automatic, secure daily backups</li>
          <li><span class="li-icon li-icon--good"><?= icon('check-circle') ?></span> Direct support from me, without a call centre</li>
          <li><span class="li-icon li-icon--good"><?= icon('check-circle') ?></span> Practical advice tailored to your business</li>
          <li><span class="li-icon li-icon--good"><?= icon('check-circle') ?></span> Fast, reliable hosting on a private server</li>
        </ul>
      </div>
    </div>
    <p class="compare__note reveal"><?= icon('arrows-left-right') ?> Keep your existing domain and website. There's no need to start again just to get better hosting.</p>
  </div>
</section>

<section class="section" data-section="how-it-works" aria-labelledby="how-title">
  <div class="container">
    <header class="section-head reveal">
      <p class="eyebrow eyebrow--dark">How moving to me works</p>
      <h2 class="h2" id="how-title">Your website moves over, your email carries on as normal</h2>
      <p class="lead lead--dark">I do the moving. You carry on running your business.</p>
    </header>
    <ol class="steps-list">
      <li class="reveal">
        <span class="steps-list__num">1</span>
        <h3 class="h4">A quick chat</h3>
        <p>Call, WhatsApp or send a message. I find out where your website, email and domain live, so nothing gets missed.</p>
      </li>
      <li class="reveal">
        <span class="steps-list__num">2</span>
        <h3 class="h4">I copy and test it</h3>
        <p>I copy your site to my server and test it privately. Your current site keeps running the whole time.</p>
      </li>
      <li class="reveal">
        <span class="steps-list__num">3</span>
        <h3 class="h4">I switch it over</h3>
        <p>I make the switch at a quiet time, on a call with you if you like. Most moves go unnoticed by your visitors.</p>
      </li>
      <li class="reveal">
        <span class="steps-list__num">4</span>
        <h3 class="h4">You deal with me</h3>
        <p>From then on, you have my number. No tickets, no queue, and the same person every time.</p>
      </li>
    </ol>
    <p class="aside-note aside-note--wide reveal"><?= icon('sparkle') ?> <span><strong>New to hosting?</strong> I'll set up your hosting, SSL and email from scratch, and explain each part in plain English as I go. <a href="/contact/?need=new#enquiry" data-cta="how-new">Start here</a>.</span></p>
  </div>
</section>

<section class="section section--dark ambient" data-section="price-teaser" aria-labelledby="price-title">
  <div class="container price-teaser">
    <div class="price-teaser__card glass reveal">
      <p class="eyebrow">Standard hosting</p>
      <h2 class="h2" id="price-title">One price, everything included</h2>
      <p class="price"><span class="price__amount"><?= money($std['price']) ?></span><span class="price__per">a year</span></p>
      <p class="price__sub">That's <?= e($std['monthly']) ?>. No VAT to add. Renews at <?= money($std['price']) ?>.</p>
      <ul class="ticks ticks--light">
        <?php foreach (array_slice($std['features'], 0, 5) as $f): ?>
          <li><?= icon('check') ?> <?= e($f) ?></li>
        <?php endforeach; ?>
      </ul>
      <div class="inline-actions">
        <a class="btn btn--primary" href="/contact/" data-cta="price-primary"><?= e(cfg('cta_primary')) ?> <?= icon('arrow-right') ?></a>
        <a class="link-quiet link-quiet--light" href="/pricing/" data-cta="price-pricing">Compare both plans</a>
      </div>
    </div>
    <div class="reassure reveal" data-section="reassurance">
      <h3 class="h3">If something worries you about moving</h3>
      <dl class="reassure__list">
        <div><dt><?= icon('truck') ?> Free migration</dt><dd>I move one website per plan for you, files, database and all, and check your email still works.</dd></div>
        <div><dt><?= icon('arrow-counter-clockwise') ?> 30-day money-back</dt><dd>Not happy in the first 30 days? I refund your hosting fee in full.</dd></div>
        <div><dt><?= icon('door-open') ?> Easy to leave</dt><dd>One month's notice, unused months refunded, and a full backup of your site to take with you.</dd></div>
        <div><dt><?= icon('shield-check') ?> Clear responsibilities</dt><dd>I look after the server, security, SSL and backups. <a class="nowrap" href="/pricing/#who-does-what">See who does what</a>.</dd></div>
      </dl>
      <p class="seal"><span class="seal__badge" aria-hidden="true"><?= icon('seal-check') ?></span><span><strong>30-day money-back guarantee</strong> on every new hosting plan. If it's not right, you get your hosting fee back.</span></p>
    </div>
  </div>
</section>

<section class="section section--paper" data-section="testimonials" aria-labelledby="reviews-title">
  <div class="container">
    <header class="section-head reveal">
      <p class="eyebrow eyebrow--dark"><?= icon('google-logo') ?> Google reviews</p>
      <h2 class="h2" id="reviews-title">Five stars on Google, in clients' own words</h2>
    </header>
    <?php include APP . '/partials/reviews.php'; ?>
  </div>
</section>

<section class="section" data-section="faq" aria-labelledby="faq-title">
  <div class="container split split--faq">
    <header class="split__side reveal">
      <h2 class="h2" id="faq-title">Questions people ask before they move</h2>
      <p class="lead lead--dark">Something else on your mind? <a href="tel:<?= e(cfg('phone_e164')) ?>" data-contact="phone">Call me</a> or <a href="<?= e(cfg('whatsapp')) ?>" rel="noopener" target="_blank" data-contact="whatsapp">send a WhatsApp</a>.</p>
      <div class="mini-person">
        <span class="person__avatar" aria-hidden="true">R</span>
        <span><strong>Ask me directly</strong><span>Usually a same-day reply</span></span>
        <a class="btn btn--ghost btn--sm" href="tel:<?= e(cfg('phone_e164')) ?>" data-contact="phone" data-cta="faq-call"><?= icon('phone') ?> <?= e(cfg('phone_display')) ?></a>
      </div>
    </header>
    <div class="split__main">
      <?php include APP . '/partials/faq.php'; ?>
    </div>
  </div>
</section>

<section class="section section--dark ambient ambient--alt" id="enquiry" data-section="enquiry" aria-labelledby="enquiry-title">
  <div class="container enquiry-wrap">
    <div class="enquiry-wrap__intro reveal">
      <h2 class="h2" id="enquiry-title">Tell me what you need</h2>
      <p class="lead">Moving an existing site or starting from scratch, I'll tell you what I'd do and what it costs. No obligation, no hard sell.</p>
    </div>
    <div class="enquiry-wrap__form glass">
      <?php include APP . '/partials/enquiry-form.php'; ?>
    </div>
    <div class="enquiry-wrap__more">
      <div class="person">
        <span class="person__avatar" aria-hidden="true">R</span>
        <span><strong>Rich</strong><span>I reply today or the next working day</span></span>
      </div>
      <ul class="contact-list">
        <li><a href="tel:<?= e(cfg('phone_e164')) ?>" data-contact="phone" data-cta="enquiry-call"><?= icon('phone') ?> <?= e(cfg('phone_display')) ?></a></li>
        <li><a href="<?= e(cfg('whatsapp')) ?>" rel="noopener" target="_blank" data-contact="whatsapp" data-cta="enquiry-whatsapp"><?= icon('whatsapp-logo') ?> WhatsApp me</a></li>
        <li><a href="mailto:<?= e(cfg('email')) ?>" data-contact="email" data-cta="enquiry-email"><?= icon('envelope-simple') ?> <?= e(cfg('email')) ?></a></li>
      </ul>
    </div>
  </div>
</section>

</main>
<?php include APP . '/partials/footer.php'; ?>
