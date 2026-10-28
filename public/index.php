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
  <canvas class="fx-grid" aria-hidden="true"></canvas>
  <div class="container hero__grid">
    <div class="hero__copy">
      <h1 class="h1" id="hero-title">Personal website hosting, without the hidden costs</h1>
      <p class="lead">I'm Rich, an independent website hosting provider based in the East Midlands. I look after over 110 business websites, providing reliable, affordable hosting with transparent pricing and personal support directly from me.</p>
      <div class="hero__actions">
        <a class="btn btn--primary btn--lg" href="/contact/" data-cta="hero-primary"><?= e(cfg('cta_primary')) ?> <?= icon('arrow-right') ?></a>
        <a class="link-quiet link-quiet--light" href="/pricing/" data-cta="hero-pricing">See my prices <?= icon('arrow-right') ?></a>
      </div>
    </div>
    <div class="hero__media">
      <?php include APP . '/partials/video.php'; ?>
    </div>
  </div>
  <div class="hero__trust" data-section="trust">
    <div class="container">
      <?php include APP . '/partials/trust-logos.php'; ?>
    </div>
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
          <span><strong>Free SSL certificates for life</strong><span>The padlock in the browser. I renew it, you never pay for it.</span></span>
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
          <li><span class="li-icon li-icon--pain"><?= icon('warning') ?></span> Unreliable or missing backups</li>
          <li><span class="li-icon li-icon--pain"><?= icon('warning') ?></span> Slow, impersonal customer support</li>
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
      <h2 class="h2" id="how-title">Your website moves over, your email carries on as normal</h2>
      <p class="lead lead--dark">I do the moving. Nothing to do from your end.</p>
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


<section class="section section--paper" data-section="testimonials" aria-labelledby="reviews-title">
  <div class="container">
    <header class="section-head section-head--split reveal">
      <div>
        <h2 class="h2" id="reviews-title">What clients say on Google</h2>
      </div>
      <?php if (cfg('reviews_url') !== ''): ?>
        <a class="link-quiet" href="<?= e(cfg('reviews_url')) ?>" rel="noopener" target="_blank" data-cta="reviews-google">See them on Google <?= icon('arrow-up-right') ?></a>
      <?php endif; ?>
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
      <p class="lead">Moving a site or starting from scratch, I'll tell you what I'd do and what it costs. Absolutely no pressure from my end.</p>
    </div>
    <div class="enquiry-wrap__form glass">
      <?php include APP . '/partials/enquiry-form.php'; ?>
    </div>
    <div class="enquiry-wrap__more">
      <div class="person">
        <span><strong>Rich</strong><span><?= e(cfg('hours')) ?></span></span>
      </div>
      <ul class="contact-list">
        <li><a href="tel:<?= e(cfg('phone_e164')) ?>" data-contact="phone" data-cta="enquiry-call"><?= icon('phone') ?> <?= e(cfg('phone_display')) ?></a></li>
        <li><a href="<?= e(cfg('whatsapp')) ?>" rel="noopener" target="_blank" data-contact="whatsapp" data-cta="enquiry-whatsapp"><?= icon('brand-whatsapp') ?> WhatsApp me</a></li>
        <li><a href="mailto:<?= e(cfg('email')) ?>" data-contact="email" data-cta="enquiry-email"><?= icon('envelope-simple') ?> <?= e(cfg('email')) ?></a></li>
      </ul>
      <ol class="mini-steps">
        <li><span><strong>I reply</strong> by email, phone or WhatsApp, whichever you pick.</span></li>
        <li><span><strong>A quick chat</strong> about your website, email and domain.</span></li>
        <li><span><strong>A clear answer:</strong> what I'd do, what it costs and when.</span></li>
      </ol>
    </div>
  </div>
</section>

</main>
<?php include APP . '/partials/footer.php'; ?>
