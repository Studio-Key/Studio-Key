<?php
defined('SK_APP') || exit;
$reviews = require APP . '/content/reviews.php';
?>
<div class="reviews">
  <?php foreach ($reviews as $slug => $r): ?>
    <figure class="review" data-review="<?= e($slug) ?>">
      <div class="stars" role="img" aria-label="5 out of 5 stars"><?= str_repeat(icon('star-fill', 'icon star'), 5) ?></div>
      <blockquote class="review__pull"><p>&ldquo;<?= e($r['pull']) ?>&rdquo;</p></blockquote>
      <details class="review__more">
        <summary>Read the full review</summary>
        <p><?= e($r['text']) ?></p>
      </details>
      <figcaption class="review__by">
        <span class="review__avatar" aria-hidden="true"><?= e(mb_substr($r['name'], 0, 1)) ?></span>
        <span><strong><?= e($r['name']) ?></strong><span class="review__src"><?= icon('google-logo', 'icon icon--sm') ?> Google review</span></span>
      </figcaption>
    </figure>
  <?php endforeach; ?>
</div>
