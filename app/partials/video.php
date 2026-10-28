<?php
/**
 * Hero sales letter video, 5:4. Shows a placeholder until the MP4 is uploaded to
 * public/assets/video/sales-letter.mp4 (poster: assets/img/video-poster.webp, captions: sales-letter.en.vtt).
 */
defined('SK_APP') || exit;
$has_video = is_file(WEB . '/assets/video/sales-letter.mp4');
$has_poster = is_file(WEB . '/assets/img/video-poster.webp');
$has_captions = is_file(WEB . '/assets/video/sales-letter.en.vtt');
?>
<figure class="video glass" data-video="sales-letter">
  <?php if ($has_video): ?>
    <video class="video__media" controls preload="none" playsinline width="1000" height="800"<?= $has_poster ? ' poster="' . e(asset('img/video-poster.webp')) . '"' : '' ?>>
      <source src="<?= e(asset('video/sales-letter.mp4')) ?>" type="video/mp4">
      <?php if ($has_captions): ?><track kind="captions" src="<?= e(asset('video/sales-letter.en.vtt')) ?>" srclang="en" label="English" default><?php endif; ?>
      Your browser can't play this video. <a href="<?= e(asset('video/sales-letter.mp4')) ?>">Download it</a> instead.
    </video>
  <?php else: ?>
    <div class="video__placeholder">
      <span class="video__play" aria-hidden="true"><?= icon('play-fill') ?></span>
      <span class="video__soon">A two-minute hello from Rich</span>
      <span class="video__note">Video coming soon</span>
    </div>
  <?php endif; ?>
  <div class="chip-float chip-float--a glass" aria-hidden="true"><?= icon('cloud-check') ?><span><strong>Daily backup done</strong><span>Stored on AWS S3</span></span></div>
  <div class="chip-float chip-float--b glass" aria-hidden="true"><?= icon('lock-key') ?><span><strong>SSL renewed for you</strong><span>No charge, ever</span></span></div>
  <figcaption class="video__caption">
    <span class="video__avatar" aria-hidden="true">R</span>
    <span><strong>Rich</strong>, the person who looks after your website</span>
  </figcaption>
</figure>
