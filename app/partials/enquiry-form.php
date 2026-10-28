<?php
/**
 * 3-step enquiry form (PRD 10.2). Works as a single long form without JavaScript;
 * form.js turns it into steps. Optional $form_id keeps ids unique if used twice.
 */
defined('SK_APP') || exit;
require_once APP . '/lib/form.php';

$fid = $form_id ?? 'enq';
$pre = is_string($_GET['need'] ?? null) && isset(form_needs()[$_GET['need']]) ? $_GET['need'] : '';
$status = is_string($_GET['status'] ?? null) ? $_GET['status'] : '';
$plan = is_string($_GET['plan'] ?? null) && isset(cfg('plans')[$_GET['plan']]) ? $_GET['plan'] : '';
if ($plan !== '' && $pre === '') {
    $pre = 'move';
}
?>
<form class="enquiry" id="<?= e($fid) ?>" action="/api/enquiry.php" method="post" data-form="enquiry" aria-describedby="<?= e($fid) ?>-intro">
  <p class="enquiry__intro" id="<?= e($fid) ?>-intro"><?php if ($plan !== ''): ?><span class="plan-pill"><?= icon('check-circle') ?> <?= e(cfg('plans')[$plan]['name']) ?> plan, <?= money(cfg('plans')[$plan]['price']) ?> a year</span> <?php endif; ?>Three quick steps. Only your name and email are required.</p>

  <ol class="steps" aria-hidden="true">
    <li class="steps__item is-active" data-step-dot="1"><span>1</span> Need</li>
    <li class="steps__item" data-step-dot="2"><span>2</span> Website</li>
    <li class="steps__item" data-step-dot="3"><span>3</span> Details</li>
  </ol>

  <?php if ($status === 'error'): ?>
    <p class="form-alert" role="alert">Something didn't go through. Please check the form, or call me on <a href="tel:<?= e(cfg('phone_e164')) ?>"><?= e(cfg('phone_display')) ?></a>.</p>
  <?php elseif ($status === 'sent'): ?>
    <p class="form-alert form-alert--ok" role="status">Thanks, I've got your message. I'll reply today or the next working day.</p>
  <?php endif; ?>

  <input type="hidden" name="token" value="<?= e(form_token()) ?>">
  <input type="hidden" name="page" value="<?= e($page['path']) ?>">
  <input type="hidden" name="plan" value="<?= e($plan) ?>">
  <input type="hidden" name="landing" value="">
  <input type="hidden" name="referrer" value="">
  <?php foreach (['source', 'medium', 'campaign', 'term', 'content'] as $k): ?>
    <input type="hidden" name="utm_<?= $k ?>" value="">
  <?php endforeach; ?>
  <div class="hp" aria-hidden="true">
    <label for="<?= e($fid) ?>-company">Leave this empty</label>
    <input type="text" id="<?= e($fid) ?>-company" name="company_url" tabindex="-1" autocomplete="off">
  </div>

  <fieldset class="step is-current" data-step="1">
    <legend class="step__title">What would help?</legend>
    <div class="choices">
      <?php foreach (form_needs() as $value => $opt): ?>
        <label class="choice">
          <input type="radio" name="need" value="<?= e($value) ?>" required<?= $pre === $value ? ' checked' : '' ?>>
          <span class="choice__body">
            <span class="choice__label"><?= e($opt['label']) ?></span>
            <span class="choice__hint"><?= e($opt['hint']) ?></span>
          </span>
          <?= icon('check-circle', 'icon choice__tick') ?>
        </label>
      <?php endforeach; ?>
    </div>
    <p class="field__error" data-error-for="need" hidden></p>
  </fieldset>

  <fieldset class="step" data-step="2">
    <legend class="step__title">Your website</legend>
    <div class="field-group" data-show-for="move check unsure">
      <div class="field">
        <label for="<?= e($fid) ?>-website">Website address <span class="opt">(optional)</span></label>
        <input id="<?= e($fid) ?>-website" name="website" type="text" inputmode="url" autocomplete="url" placeholder="yourbusiness.co.uk" maxlength="200">
      </div>
      <div class="field">
        <label for="<?= e($fid) ?>-host">Who hosts it now? <span class="opt">(optional, a guess is fine)</span></label>
        <input id="<?= e($fid) ?>-host" name="host" type="text" placeholder="e.g. GoDaddy, 123 Reg" maxlength="100">
      </div>
      <fieldset class="field">
        <legend>What's bugging you? <span class="opt">(optional)</span></legend>
        <div class="chips">
          <?php foreach (form_pains() as $value => $label): ?>
            <label class="chip"><input type="checkbox" name="pains[]" value="<?= e($value) ?>"><span><?= e($label) ?></span></label>
          <?php endforeach; ?>
        </div>
      </fieldset>
    </div>
    <div class="field-group" data-show-for="new">
      <div class="field">
        <label for="<?= e($fid) ?>-domain">Your domain name, if you have one <span class="opt">(optional)</span></label>
        <input id="<?= e($fid) ?>-domain" name="domain" type="text" placeholder="yourbusiness.co.uk" maxlength="200">
      </div>
      <fieldset class="field">
        <legend>Do you need the website built too?</legend>
        <div class="segmented">
          <label><input type="radio" name="build" value="yes"><span>Yes</span></label>
          <label><input type="radio" name="build" value="no" checked><span>No, hosting only</span></label>
        </div>
      </fieldset>
    </div>
  </fieldset>

  <fieldset class="step" data-step="3">
    <legend class="step__title">Your details</legend>
    <div class="field-row">
      <div class="field">
        <label for="<?= e($fid) ?>-name">Your name</label>
        <input id="<?= e($fid) ?>-name" name="name" type="text" autocomplete="name" required maxlength="100" aria-describedby="<?= e($fid) ?>-name-err">
        <p class="field__error" id="<?= e($fid) ?>-name-err" data-error-for="name" hidden></p>
      </div>
      <div class="field">
        <label for="<?= e($fid) ?>-email">Email</label>
        <input id="<?= e($fid) ?>-email" name="email" type="email" autocomplete="email" required maxlength="254" aria-describedby="<?= e($fid) ?>-email-err">
        <p class="field__error" id="<?= e($fid) ?>-email-err" data-error-for="email" hidden></p>
      </div>
    </div>
    <fieldset class="field">
      <legend>How should I reply?</legend>
      <div class="segmented">
        <?php foreach (form_replies() as $value => $label): ?>
          <label><input type="radio" name="reply" value="<?= e($value) ?>"<?= $value === 'email' ? ' checked' : '' ?>><span><?= e($label) ?></span></label>
        <?php endforeach; ?>
      </div>
    </fieldset>
    <div class="field">
      <label for="<?= e($fid) ?>-phone">Phone <span class="opt" data-phone-opt>(optional)</span></label>
      <input id="<?= e($fid) ?>-phone" name="phone" type="tel" autocomplete="tel" inputmode="tel" maxlength="30" aria-describedby="<?= e($fid) ?>-phone-err">
      <p class="field__error" id="<?= e($fid) ?>-phone-err" data-error-for="phone" hidden></p>
    </div>
    <div class="field">
      <label for="<?= e($fid) ?>-message">Anything else? <span class="opt">(optional)</span></label>
      <textarea id="<?= e($fid) ?>-message" name="message" rows="3" maxlength="2000"></textarea>
    </div>
    <label class="check">
      <input type="checkbox" name="tips" value="yes">
      <span>Send me the odd hosting tip by email, no more than once a month. Unsubscribe any time.</span>
    </label>
    <p class="enquiry__privacy">I'll only use your details to reply to this enquiry. See my <a href="/privacy/">privacy notice</a>.</p>
  </fieldset>

  <div class="enquiry__nav">
    <button type="button" class="btn btn--ghost js-only" data-prev hidden>Back</button>
    <button type="button" class="btn btn--primary js-only" data-next hidden>Next <?= icon('arrow-right') ?></button>
    <button type="submit" class="btn btn--primary" data-submit>Send my message <?= icon('paper-plane-tilt') ?></button>
  </div>
  <p class="enquiry__status" role="status" aria-live="polite"></p>
  <p class="enquiry__promise"><?= icon('clock') ?> I reply today or the next working day. No obligation.</p>
</form>

<div class="enquiry-done" id="<?= e($fid) ?>-done" hidden tabindex="-1">
  <?= icon('check-circle', 'icon enquiry-done__icon') ?>
  <h3 class="enquiry-done__title">Thanks, <span data-done-name>I've got it</span>.</h3>
  <p>I'll reply today or the next working day. If it's urgent, call or WhatsApp me.</p>
  <div class="enquiry-done__actions">
    <a class="btn btn--light btn--sm" href="tel:<?= e(cfg('phone_e164')) ?>" data-contact="phone"><?= icon('phone') ?> <?= e(cfg('phone_display')) ?></a>
    <a class="btn btn--light btn--sm" href="<?= e(cfg('whatsapp')) ?>" rel="noopener" target="_blank" data-contact="whatsapp"><?= icon('whatsapp-logo') ?> WhatsApp</a>
  </div>
</div>
