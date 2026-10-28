<?php
defined('SK_APP') || exit;
$current = $page['path'];
?>
<body data-page="<?= e($page['id']) ?>">
<a class="skip" href="#main">Skip to content</a>
<header class="site-header" data-section="header">
  <div class="container site-header__inner">
    <a class="site-header__logo" href="/" aria-label="Studio Key home"><?php include APP . '/partials/logo.svg.php'; ?></a>

    <nav class="nav" aria-label="Main">
      <ul class="nav__list">
        <?php foreach (cfg('nav') as $href => $label): ?>
          <li><a class="nav__link" href="<?= e($href) ?>"<?= $current === $href ? ' aria-current="page"' : '' ?> data-cta="nav-<?= e(strtolower($label)) ?>"><?= e($label) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <div class="site-header__actions">
      <a class="site-header__phone" href="tel:<?= e(cfg('phone_e164')) ?>" data-contact="phone" data-cta="header-call">
        <?= icon('phone') ?><span><?= e(cfg('phone_display')) ?></span>
      </a>
      <a class="btn btn--primary btn--sm site-header__cta<?= $current === '/contact/' ? ' is-here' : '' ?>" href="/contact/" data-cta="header-primary"<?= $current === '/contact/' ? ' aria-hidden="true" tabindex="-1"' : '' ?>><?= e(cfg('cta_primary')) ?></a>
      <button class="menu-btn" type="button" popovertarget="mobile-menu" aria-label="Open menu" data-cta="menu-open"><?= icon('list') ?></button>
    </div>
  </div>
</header>

<div id="mobile-menu" class="mobile-menu glass" popover>
  <div class="mobile-menu__top">
    <span class="mobile-menu__title">Menu</span>
    <button class="menu-btn" type="button" popovertarget="mobile-menu" popovertargetaction="hide" aria-label="Close menu"><?= icon('x') ?></button>
  </div>
  <nav aria-label="Mobile">
    <ul class="mobile-menu__list">
      <li><a href="/"<?= $current === '/' ? ' aria-current="page"' : '' ?>>Home</a></li>
      <?php foreach (cfg('nav') as $href => $label): ?>
        <li><a href="<?= e($href) ?>"<?= $current === $href ? ' aria-current="page"' : '' ?>><?= e($label) ?></a></li>
      <?php endforeach; ?>
    </ul>
  </nav>
  <a class="btn btn--primary btn--block" href="/contact/" data-cta="menu-primary"><?= e(cfg('cta_primary')) ?></a>
  <a class="mobile-menu__phone" href="tel:<?= e(cfg('phone_e164')) ?>" data-contact="phone"><?= icon('phone') ?> <?= e(cfg('phone_display')) ?></a>
</div>
