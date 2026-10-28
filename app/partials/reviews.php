<?php
defined('SK_APP') || exit;
$reviews = require APP . '/content/reviews.php';
?>
<div class="reviews">
  <?php foreach ($reviews as $slug => $r): ?>
    <figure class="review" data-review="<?= e($slug) ?>">
      <div class="stars" role="img" aria-label="5 out of 5 stars"><?= str_repeat(icon('star-fill', 'icon star'), 5) ?></div>
      <blockquote class="review__pull"><p>&ldquo;<?= e($r['pull']) ?>&rdquo;</p></blockquote>
      <button type="button" class="review__more" popovertarget="review-<?= e($slug) ?>">Read the full review</button>
      <div class="review-pop glass" id="review-<?= e($slug) ?>" popover data-review-full="<?= e($slug) ?>">
        <button type="button" class="review-pop__close" popovertarget="review-<?= e($slug) ?>" popovertargetaction="hide" aria-label="Close review"><?= icon('x') ?></button>
        <span class="review-pop__mark" aria-hidden="true">&ldquo;</span>
        <div class="stars stars--sm" aria-hidden="true"><?= str_repeat(icon('star-fill', 'icon star'), 5) ?></div>
        <p class="review-pop__text"><?= e($r['text']) ?></p>
        <p class="review-pop__by"><span><strong><?= e($r['name']) ?></strong><span class="review__src"><?= icon('brand-google', 'icon icon--sm') ?> Google review</span></span></p>
      </div>
      <figcaption class="review__by">
        <span><strong><?= e($r['name']) ?></strong><span class="review__src"><?= icon('brand-google', 'icon icon--sm') ?> Google review</span></span>
      </figcaption>
    </figure>
  <?php endforeach; ?>
</div>
