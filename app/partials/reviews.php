<?php
defined('SK_APP') || exit;
$reviews = require APP . '/content/reviews.php';
?>
<div class="reviews" role="region" aria-label="Google reviews" tabindex="0">
  <?php foreach ($reviews as $slug => $r): ?>
    <figure class="review" data-review="<?= e($slug) ?>">
      <div class="stars" role="img" aria-label="5 out of 5 stars"><?= str_repeat(icon('star-fill', 'icon star'), 5) ?></div>
      <blockquote class="review__pull"><p>&ldquo;<?= e($r['pull']) ?>&rdquo;</p></blockquote>
      <button type="button" class="review__more" popovertarget="review-<?= e($slug) ?>">Read the full review</button>
      <div class="review-pop glass" id="review-<?= e($slug) ?>" popover data-review-full="<?= e($slug) ?>">
        <div class="stars stars--sm" aria-hidden="true"><?= str_repeat(icon('star-fill', 'icon star'), 5) ?></div>
        <p><?= e($r['text']) ?></p>
        <p class="review-pop__by"><strong><?= e($r['name']) ?></strong>, Google review</p>
        <button type="button" class="btn btn--light btn--sm" popovertarget="review-<?= e($slug) ?>" popovertargetaction="hide">Close</button>
      </div>
      <figcaption class="review__by">
        <span class="review__avatar" aria-hidden="true"><?= e(mb_substr($r['name'], 0, 1)) ?></span>
        <span><strong><?= e($r['name']) ?></strong><span class="review__src"><?= icon('google-logo', 'icon icon--sm') ?> Google review</span></span>
      </figcaption>
    </figure>
  <?php endforeach; ?>
</div>
