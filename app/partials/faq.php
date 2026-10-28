<?php
/**
 * Expects $faqs (array from content/faqs.php) and optional $faq_title.
 * Native <details> so it works without JavaScript.
 */
defined('SK_APP') || exit;
?>
<div class="faq">
  <?php foreach ($faqs as $slug => $item): ?>
    <details class="faq__item" data-faq="<?= e($slug) ?>">
      <summary class="faq__q"><span><?= e($item['q']) ?></span><span class="faq__icon" aria-hidden="true"></span></summary>
      <div class="faq__a"><p><?= e($item['a']) ?></p></div>
    </details>
  <?php endforeach; ?>
</div>
