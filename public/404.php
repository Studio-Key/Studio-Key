<?php
require __DIR__ . '/../app/bootstrap.php';
http_response_code(404);

$page = [
    'id' => '404',
    'path' => '/404',
    'title' => 'Page Not Found | Studio Key',
    'description' => 'That page has moved or no longer exists.',
    'robots' => 'noindex, follow',
];
include APP . '/partials/head.php';
include APP . '/partials/header.php';
?>
<main id="main">
<section class="section section--dark ambient not-found" data-section="not-found" aria-labelledby="nf-title">
  <div class="container">
    <h1 class="h1" id="nf-title">That page has moved, or never existed</h1>
    <p class="lead">I've rebuilt this website, so some old links point nowhere. One of these should get you where you need to be.</p>
    <div class="not-found__links">
      <a class="btn btn--primary btn--lg" href="/" data-cta="404-home">Home page <?= icon('arrow-right') ?></a>
      <a class="link-quiet" href="/pricing/" data-cta="404-pricing">See my prices <?= icon('arrow-right') ?></a>
      <a class="link-quiet" href="/contact/" data-cta="404-contact">Contact me <?= icon('arrow-right') ?></a>
    </div>
  </div>
</section>
</main>
<?php include APP . '/partials/footer.php'; ?>
