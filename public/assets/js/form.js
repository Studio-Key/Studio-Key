/* Studio Key: 3-step enquiry form with progressive disclosure.
   Without this file the form still works as one long page posting to /api/enquiry.php. */
(() => {
  'use strict';
  window.SKF = true;
  const track = (e, d) => window.SK && window.SK.track(e, d);

  document.querySelectorAll('form[data-form="enquiry"]').forEach((form) => {
    const steps = [...form.querySelectorAll('.step')];
    const dots = [...form.querySelectorAll('[data-step-dot]')];
    const prev = form.querySelector('[data-prev]');
    const next = form.querySelector('[data-next]');
    const submit = form.querySelector('[data-submit]');
    const status = form.querySelector('.enquiry__status');
    const done = document.getElementById(form.id + '-done');
    const last = steps.length - 1;
    let current = 0;
    let sending = false;

    form.noValidate = true;

    // Attribution into hidden fields (consent decides what is available, see main.js).
    const a = window.SK ? window.SK.attribution() : { utm: {}, landing: location.pathname, referrer: document.referrer };
    const setHidden = (name, value) => { const el = form.elements.namedItem(name); if (el) el.value = value || ''; };
    setHidden('landing', a.landing);
    setHidden('referrer', a.referrer);
    Object.keys(a.utm || {}).forEach((k) => setHidden('utm_' + k, a.utm[k]));

    const need = () => form.querySelector('input[name="need"]:checked')?.value || '';
    const reply = () => form.querySelector('input[name="reply"]:checked')?.value || 'email';

    const applyNeed = () => {
      const v = need() || 'move';
      form.querySelectorAll('[data-show-for]').forEach((g) => g.toggleAttribute('data-hidden', !g.dataset.showFor.split(' ').includes(v)));
    };
    const applyReply = () => {
      const opt = form.querySelector('[data-phone-opt]');
      if (opt) opt.hidden = reply() !== 'email';
    };

    const show = (n, focus) => {
      current = n;
      steps.forEach((s, i) => s.classList.toggle('is-current', i === n));
      dots.forEach((dot, i) => {
        dot.classList.toggle('is-active', i === n);
        dot.classList.toggle('is-done', i < n);
      });
      prev.hidden = n === 0;
      next.hidden = n === last;
      submit.hidden = n !== last;
      status.textContent = '';
      if (focus) {
        const target = steps[n].querySelector('input:not([type="hidden"]):checked, input:not([type="hidden"]):not([type="radio"]):not([type="checkbox"]), input, textarea');
        target?.focus({ preventScroll: true });
        const top = form.getBoundingClientRect().top + scrollY - 96;
        if (top < scrollY) scrollTo({ top, behavior: matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth' });
      }
      track('form_step_view', { step: n + 1 });
    };

    const fieldError = (name, message) => {
      const el = form.querySelector('[data-error-for="' + name + '"]');
      const input = form.elements.namedItem(name);
      if (el) { el.textContent = message || ''; el.hidden = !message; }
      if (input && input.setAttribute) input.setAttribute('aria-invalid', message ? 'true' : 'false');
    };
    const clearErrors = () => form.querySelectorAll('[data-error-for]').forEach((el) => fieldError(el.dataset.errorFor, ''));

    const validate = (n) => {
      const errors = {};
      if (n === 0 && !need()) errors.need = 'Pick the option that fits best.';
      if (n === 2) {
        const name = form.elements.namedItem('name').value.trim();
        const email = form.elements.namedItem('email').value.trim();
        const phone = form.elements.namedItem('phone').value.trim();
        if (!name) errors.name = 'Please tell me your name.';
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(email)) errors.email = 'Please check your email address.';
        if (phone && !/^[0-9 +()-]{7,30}$/.test(phone)) errors.phone = 'Please check your phone number.';
        if (!phone && reply() !== 'email') errors.phone = 'I need a number to ' + (reply() === 'call' ? 'call you' : 'WhatsApp you') + '.';
      }
      return errors;
    };

    const showErrors = (errors) => {
      clearErrors();
      Object.keys(errors).forEach((k) => fieldError(k, errors[k]));
      const first = Object.keys(errors)[0];
      if (first) {
        track('form_error', { step: current + 1, field: first });
        const input = form.elements.namedItem(first);
        (input && input.focus ? input : (input && input[0]))?.focus?.();
      }
    };

    const goNext = () => {
      const errors = validate(current);
      if (Object.keys(errors).length) { showErrors(errors); return; }
      clearErrors();
      track('form_step_complete', { step: current + 1 });
      if (current < last) show(current + 1, true);
    };

    next.addEventListener('click', goNext);
    prev.addEventListener('click', () => show(Math.max(0, current - 1), true));

    // One tap on step 1 moves on. Keyboard selection (detail === 0) does not, so arrow keys stay predictable.
    form.querySelectorAll('input[name="need"]').forEach((r) => {
      r.addEventListener('change', () => { applyNeed(); fieldError('need', ''); });
      r.closest('.choice').addEventListener('click', (e) => {
        if (e.detail > 0 && current === 0) setTimeout(() => { if (need()) goNext(); }, 260);
      });
    });
    form.querySelectorAll('input[name="reply"]').forEach((r) => r.addEventListener('change', applyReply));

    // Enter in a text field moves to the next step instead of submitting early.
    form.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' && e.target.tagName === 'INPUT' && current < last) { e.preventDefault(); goNext(); }
    });

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      if (sending) return;
      if (current < last) { goNext(); return; }
      for (let i = 0; i <= last; i += 1) {
        const errors = validate(i);
        if (Object.keys(errors).length) { if (i !== current) show(i, false); showErrors(errors); return; }
      }
      sending = true;
      form.classList.add('is-sending');
      status.textContent = '';
      submit.disabled = true;
      try {
        const res = await fetch(form.action, { method: 'POST', body: new FormData(form), headers: { Accept: 'application/json' }, credentials: 'same-origin' });
        let data = {};
        try { data = await res.json(); } catch (_) { /* non-JSON */ }
        if (res.ok && data.ok) {
          track('form_submit', { need: need(), reply: reply() });
          form.hidden = true;
          if (done) {
            const nm = done.querySelector('[data-done-name]');
            if (nm && data.name) nm.textContent = data.name;
            done.hidden = false;
            done.focus();
          }
          return;
        }
        if (data.errors) {
          const field = Object.keys(data.errors)[0];
          const stepOf = field === 'need' ? 0 : 2;
          if (stepOf !== current) show(stepOf, false);
          showErrors(data.errors);
        }
        status.textContent = data.message || 'Something went wrong. Please try again, or call me.';
        track('form_error', { step: current + 1, field: 'server', code: res.status });
      } catch (_) {
        status.textContent = 'I couldn\'t send that. Please check your connection and try again, or call me.';
        track('form_error', { step: current + 1, field: 'network' });
      } finally {
        sending = false;
        form.classList.remove('is-sending');
        submit.disabled = false;
      }
    });

    applyNeed();
    applyReply();
    show(0, false);
  });
})();
