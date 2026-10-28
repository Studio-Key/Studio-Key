<?php defined('SK_APP') || exit; ?>
<ul class="trust" aria-label="Why you can trust this hosting">
  <li class="trust__item">
    <a class="trust__link" href="<?= e(cfg('green_check_url')) ?>" rel="noopener" target="_blank" data-cta="trust-green">
      <?= icon('leaf', 'icon trust__icon') ?>
      <span><strong>Green hosting</strong> Verified by Green Web Foundation</span>
    </a>
  </li>
  <li class="trust__item">
    <?= icon('brand-google', 'icon trust__icon') ?>
    <span><strong>5-star Google reviews</strong><span class="stars stars--sm" role="img" aria-label="5 out of 5 stars"><?= str_repeat(icon('star-fill', 'icon star'), 5) ?></span></span>
  </li>
  <li class="trust__item">
    <?= icon('brand-aws', 'icon trust__icon trust__icon--aws') ?>
    <span><strong>Daily backups</strong> stored on Amazon Web Services</span>
  </li>
  <li class="trust__item">
    <?= icon('globe-hemisphere-west', 'icon trust__icon') ?>
    <span><strong><?= e(cfg('sites_count')) ?> business websites</strong> looked after</span>
  </li>
</ul>
