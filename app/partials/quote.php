<?php
/** One short Google review pull quote. Expects $quote (review slug). */
defined('SK_APP') || exit;
$all_reviews ??= require APP . '/content/reviews.php';
$q = $all_reviews[$quote] ?? null;
if (!$q) {
    return;
}
?>
<figure class="quote" data-review="<?= e($quote) ?>">
  <div class="stars stars--sm" role="img" aria-label="5 out of 5 stars"><?= str_repeat(icon('star-fill', 'icon star'), 5) ?></div>
  <blockquote><p>&ldquo;<?= e($q['pull']) ?>&rdquo;</p></blockquote>
  <figcaption><?= e($q['name']) ?>, Google review</figcaption>
</figure>
