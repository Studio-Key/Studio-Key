<?php defined('SK_APP') || exit; ?>
<footer class="site-footer" data-section="footer">
  <div class="container">
    <div class="site-footer__grid">
      <div class="site-footer__brand">
        <a href="/" class="site-footer__logo" aria-label="Studio Key home"><?php include APP . '/partials/logo.svg.php'; ?></a>
        <p>Personal website hosting from Rich. <?= e(cfg('area_line')) ?>.</p>
        <a class="green-badge" href="<?= e(cfg('green_check_url')) ?>" rel="noopener" target="_blank" data-cta="footer-green">
          <img src="/assets/img/logos/green-web-foundation.png" width="200" height="95" alt="This website runs on green hosting, verified by the Green Web Foundation" decoding="async">
        </a>
      </div>

      <nav class="site-footer__col" aria-label="Footer">
        <h2 class="site-footer__heading">Pages</h2>
        <ul>
          <li><a href="/">Home</a></li>
          <?php foreach (cfg('nav') as $href => $label): ?>
            <li><a href="<?= e($href) ?>"><?= e($label) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </nav>

      <div class="site-footer__col site-footer__col--contact">
        <h2 class="site-footer__heading">Get in touch</h2>
        <ul>
          <li><a href="tel:<?= e(cfg('phone_e164')) ?>" data-contact="phone" data-cta="footer-call"><?= icon('phone') ?> <?= e(cfg('phone_display')) ?></a></li>
          <li><a href="<?= e(cfg('whatsapp')) ?>" rel="noopener" target="_blank" data-contact="whatsapp" data-cta="footer-whatsapp"><?= icon('whatsapp-logo') ?> WhatsApp me</a></li>
          <li><a href="mailto:<?= e(cfg('email')) ?>" data-contact="email" data-cta="footer-email"><?= icon('envelope-simple') ?> <?= e(cfg('email')) ?></a></li>
          <li class="site-footer__hours"><?= e(cfg('hours')) ?></li>
        </ul>
      </div>

      <div class="site-footer__col">
        <h2 class="site-footer__heading">The small print</h2>
        <ul>
          <li><a href="/terms/">Hosting terms</a></li>
          <li><a href="/privacy/">Privacy and cookies</a></li>
          <li><button type="button" class="linklike" data-consent-open>Cookie settings</button></li>
        </ul>
      </div>
    </div>

    <p class="site-footer__legal">
      Studio Key is a trading name of <?= e(cfg('legal_name')) ?>. Registered in England and Wales, company no. <?= e(cfg('company_no')) ?>.
      Registered office: <?= e(cfg('office')) ?>. Not VAT registered. &copy;&nbsp;<?= date('Y') ?>&nbsp;<?= e(cfg('legal_name')) ?>.
    </p>
  </div>
</footer>

<?php if (!in_array($page['id'], ['privacy', 'terms'], true)): ?>
<nav class="sticky-bar glass" aria-label="Quick contact" data-section="sticky-bar">
  <a href="tel:<?= e(cfg('phone_e164')) ?>" data-contact="phone" data-cta="sticky-call"><?= icon('phone') ?><span>Call</span></a>
  <a href="<?= e(cfg('whatsapp')) ?>" rel="noopener" target="_blank" data-contact="whatsapp" data-cta="sticky-whatsapp"><?= icon('whatsapp-logo') ?><span>WhatsApp</span></a>
  <a class="sticky-bar__primary" href="/contact/" data-cta="sticky-primary"><?= e(cfg('cta_primary')) ?></a>
</nav>
<?php endif; ?>

<?php include APP . '/partials/consent.php'; ?>
<?php foreach ($page['scripts'] ?? [] as $script): ?>
<script src="<?= e(asset('js/' . $script)) ?>" defer></script>
<?php endforeach; ?>
</body>
</html>
