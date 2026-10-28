<?php
/** End-of-page call to action. Optional $cta_title and $cta_text. */
defined('SK_APP') || exit;
?>
<section class="section section--dark cta-band ambient" data-section="cta">
  <div class="container cta-band__inner">
    <div>
      <h2 class="h2"><?= e($cta_title ?? 'Ready to make hosting one less thing to think about?') ?></h2>
      <p class="lead"><?= e($cta_text ?? 'Tell me what you have now, or what you need. I\'ll reply today or the next working day, and there\'s no obligation.') ?></p>
    </div>
    <div class="cta-band__actions">
      <a class="btn btn--primary btn--lg" href="/contact/" data-cta="band-primary"><?= e(cfg('cta_primary')) ?> <?= icon('arrow-right') ?></a>
      <a class="link-quiet link-quiet--light" href="tel:<?= e(cfg('phone_e164')) ?>" data-contact="phone" data-cta="band-call">Or call me on <?= e(cfg('phone_display')) ?></a>
    </div>
  </div>
</section>
