/* Studio Key: site behaviour and consent-gated tracking.
   Nothing that stores or sends data runs until the visitor accepts cookies.
   Event names and data-* hooks are stable: the future dashboard keys on them (docs/file-plan.md, section 6). */
(() => {
  'use strict';
  const d = document;
  const body = d.body;
  const page = body.dataset.page || '';
  const CONSENT_KEY = 'sk_consent';

  let cfg = {};
  try { cfg = JSON.parse(d.getElementById('sk-config')?.textContent || '{}'); } catch (_) { /* keep defaults */ }

  // Storage can throw (private mode, blocked site data), so every call is wrapped.
  const safe = (area) => ({
    get(k) { try { return window[area].getItem(k); } catch (_) { return null; } },
    set(k, v) { try { window[area].setItem(k, v); } catch (_) { /* ignore */ } },
    del(k) { try { window[area].removeItem(k); } catch (_) { /* ignore */ } },
  });
  const local = safe('localStorage');
  const session = safe('sessionStorage');

  let consent = local.get(CONSENT_KEY); // 'granted' | 'denied' | null
  const granted = () => consent === 'granted';

  /* ---------- Attribution (UTM, landing page, referrer) ---------- */
  const UTM_KEYS = ['source', 'medium', 'campaign', 'term', 'content'];
  const fromUrl = () => {
    const p = new URLSearchParams(location.search);
    const utm = {};
    UTM_KEYS.forEach((k) => { const v = p.get('utm_' + k); if (v) utm[k] = v.slice(0, 100); });
    return utm;
  };
  const sameSiteReferrer = () => {
    try { return d.referrer && new URL(d.referrer).host === location.host; } catch (_) { return false; }
  };
  const storeAttribution = () => {
    if (!granted() || session.get('sk_attr')) return;
    session.set('sk_attr', JSON.stringify({
      utm: fromUrl(),
      landing: location.pathname + location.search,
      referrer: sameSiteReferrer() ? '' : d.referrer,
    }));
  };
  // Without consent nothing is stored: the form only gets what is on the current URL.
  const attribution = () => {
    if (granted()) {
      try { const a = JSON.parse(session.get('sk_attr') || 'null'); if (a) return a; } catch (_) { /* fall through */ }
    }
    return { utm: fromUrl(), landing: location.pathname + location.search, referrer: sameSiteReferrer() ? '' : d.referrer };
  };

  /* ---------- Event layer ---------- */
  window.dataLayer = window.dataLayer || [];
  const sessionId = () => {
    let id = session.get('sk_sid');
    if (!id) {
      id = (crypto.randomUUID ? crypto.randomUUID() : String(Date.now()) + Math.random().toString(16).slice(2));
      session.set('sk_sid', id);
    }
    return id;
  };

  const track = (event, data = {}) => {
    if (!granted()) return;
    const a = attribution();
    const payload = Object.assign({ event, page, ts: Date.now(), session: sessionId(), utm_campaign: a.utm.campaign || '', utm_source: a.utm.source || '' }, data);
    window.dataLayer.push(payload);
    if (cfg.ga4 && typeof window.gtag === 'function') window.gtag('event', event, data);
    if (cfg.collector && navigator.sendBeacon) {
      try { navigator.sendBeacon(cfg.collector, new Blob([JSON.stringify(payload)], { type: 'application/json' })); } catch (_) { /* ignore */ }
    }
  };

  window.SK = { track, attribution, granted };

  /* ---------- GA4 (only with consent and an ID) ---------- */
  let gaLoaded = false;
  const loadGA = () => {
    if (gaLoaded || !cfg.ga4 || !granted()) return;
    gaLoaded = true;
    window.gtag = function gtag() { window.dataLayer.push(arguments); };
    window.gtag('consent', 'default', { ad_storage: 'denied', ad_user_data: 'denied', ad_personalization: 'denied', analytics_storage: 'granted' });
    window.gtag('js', new Date());
    window.gtag('config', cfg.ga4, { anonymize_ip: true });
    const s = d.createElement('script');
    s.async = true;
    s.src = 'https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(cfg.ga4);
    d.head.appendChild(s);
  };

  const clearAnalyticsCookies = () => {
    d.cookie.split(';').forEach((c) => {
      const name = c.split('=')[0].trim();
      if (/^_ga/.test(name)) {
        const host = location.hostname.replace(/^www\./, '');
        ['', '; domain=' + host, '; domain=.' + host].forEach((dom) => { d.cookie = name + '=; Max-Age=0; path=/' + dom; });
      }
    });
    session.del('sk_attr');
    session.del('sk_sid');
  };

  /* ---------- Consent banner ---------- */
  const banner = d.getElementById('consent');
  const startTracking = () => {
    storeAttribution();
    loadGA();
    track('page_view', { title: d.title, path: location.pathname });
    observeSections();
  };
  const setConsent = (value) => {
    consent = value;
    local.set(CONSENT_KEY, value);
    showBanner(false);
    if (value === 'granted') startTracking();
    else clearAnalyticsCookies();
  };
  const showBanner = (show) => { if (banner) { banner.hidden = !show; body.classList.toggle('consent-open', show); } };
  if (banner) {
    if (!consent) showBanner(true);
    banner.addEventListener('click', (e) => {
      const b = e.target.closest('[data-consent]');
      if (b) setConsent(b.dataset.consent);
    });
  }
  d.addEventListener('click', (e) => {
    if (e.target.closest('[data-consent-open]') && banner) {
      showBanner(true);
      banner.querySelector('button')?.focus();
    }
  });

  /* ---------- Click tracking (CTAs, contact links) ---------- */
  d.addEventListener('click', (e) => {
    const el = e.target.closest('[data-cta], [data-contact]');
    if (!el) return;
    const section = el.closest('[data-section]')?.dataset.section || '';
    if (el.dataset.contact) track('contact_click', { id: el.dataset.contact, section, cta: el.dataset.cta || '' });
    else track('cta_click', { id: el.dataset.cta, section, text: (el.textContent || '').trim().slice(0, 60) });
  });

  /* ---------- FAQ and review expands ---------- */
  d.addEventListener('toggle', (e) => {
    const el = e.target;
    if (el.dataset && el.dataset.reviewFull && e.newState === 'open') { track('review_expand', { id: el.dataset.reviewFull }); return; }
    if (!(el instanceof HTMLDetailsElement) || !el.open) return;
    if (el.dataset.faq) track('faq_open', { id: el.dataset.faq });
    const review = el.closest('[data-review]');
    if (review) track('review_expand', { id: review.dataset.review });
  }, true);

  /* ---------- Section views ---------- */
  let sectionsObserved = false;
  function observeSections() {
    if (sectionsObserved || !('IntersectionObserver' in window)) return;
    sectionsObserved = true;
    const seen = new Set();
    const io = new IntersectionObserver((entries) => {
      entries.forEach((en) => {
        const id = en.target.dataset.section;
        if (en.isIntersecting && !seen.has(id)) { seen.add(id); track('section_view', { id }); io.unobserve(en.target); }
      });
    }, { threshold: 0.35 });
    d.querySelectorAll('main [data-section]').forEach((s) => io.observe(s));
  }

  /* ---------- Scroll depth and dwell time ---------- */
  const marks = [25, 50, 75, 90];
  const hit = new Set();
  let ticking = false;
  window.addEventListener('scroll', () => {
    if (ticking || !granted()) return;
    ticking = true;
    requestAnimationFrame(() => {
      const h = d.documentElement.scrollHeight - innerHeight;
      const pct = h > 0 ? Math.round((scrollY / h) * 100) : 100;
      marks.forEach((m) => { if (pct >= m && !hit.has(m)) { hit.add(m); track('scroll_depth', { percent: m }); } });
      ticking = false;
    });
  }, { passive: true });

  let visibleSince = d.visibilityState === 'visible' ? performance.now() : 0;
  let dwell = 0;
  let dwellSent = false;
  d.addEventListener('visibilitychange', () => {
    if (d.visibilityState === 'hidden') {
      if (visibleSince) dwell += performance.now() - visibleSince;
      visibleSince = 0;
      if (!dwellSent) { dwellSent = true; track('dwell', { ms: Math.round(dwell), max_scroll: Math.max(0, ...hit) }); }
    } else {
      visibleSince = performance.now();
    }
  });

  /* ---------- Video ---------- */
  const video = d.querySelector('[data-video] video');
  if (video) {
    const sent = new Set();
    video.addEventListener('play', () => track('video_play', { id: 'sales-letter' }));
    video.addEventListener('ended', () => track('video_complete', { id: 'sales-letter' }));
    video.addEventListener('timeupdate', () => {
      if (!video.duration) return;
      const pct = Math.floor((video.currentTime / video.duration) * 4) * 25;
      if (pct > 0 && pct < 100 && !sent.has(pct)) { sent.add(pct); track('video_progress', { id: 'sales-letter', percent: pct }); }
    });
  }

  /* ---------- Sticky mobile bar: hidden while the hero's own button or the form is on screen ---------- */
  const bar = d.querySelector('.sticky-bar');
  const watch = [d.querySelector('.hero__actions'), d.querySelector('.plans'), d.querySelector('.not-found__links'), d.querySelector('[data-section="enquiry"]')].filter(Boolean);
  if (bar && watch.length && 'IntersectionObserver' in window) {
    const onScreen = new Set();
    bar.classList.add('is-hidden');
    const io = new IntersectionObserver((entries) => {
      entries.forEach((en) => (en.isIntersecting ? onScreen.add(en.target) : onScreen.delete(en.target)));
      bar.classList.toggle('is-hidden', onScreen.size > 0);
    }, { threshold: 0 });
    watch.forEach((el) => io.observe(el));
  }

  /* ---------- Menu fallback for browsers without the popover API ---------- */
  const menu = d.getElementById('mobile-menu');
  if (menu && 'popover' in HTMLElement.prototype) {
    // Move focus into the menu when it opens; the popover API returns it on close.
    menu.addEventListener('toggle', (e) => { if (e.newState === 'open') menu.querySelector('a')?.focus(); });
  }
  if (menu && !('popover' in HTMLElement.prototype)) {
    menu.removeAttribute('popover');
    menu.hidden = true;
    menu.classList.add('is-fallback');
    d.querySelectorAll('[popovertarget="mobile-menu"]').forEach((b) => b.addEventListener('click', () => { menu.hidden = !menu.hidden; }));
  }

  /* ---------- Entrance animations (staggered per group) ---------- */
  const revealSel = '.reveal, .review, .plan, .term, .extra, .values > li, .next-steps > li, .steps-list > li, .compare__col, .faq__item, .quote, .mini-person, .town-list > li, .areas__map, .duties, .enquiry-wrap__form, .cta-band__inner, .plans-proof > *';
  const revealEls = [...d.querySelectorAll(revealSel)];
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!('IntersectionObserver' in window) || reduce) {
    revealEls.forEach((el) => el.classList.add('is-in'));
  } else {
    revealEls.forEach((el) => {
      const sibs = [...el.parentElement.children].filter((c) => c.matches(revealSel));
      el.style.setProperty('--i', String(Math.min(sibs.indexOf(el), 6)));
    });
    const rio = new IntersectionObserver((entries) => {
      entries.forEach((en) => { if (en.isIntersecting) { en.target.classList.add('is-in'); rio.unobserve(en.target); } });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.05 });
    revealEls.forEach((el) => rio.observe(el));
  }

  /* ---------- Hero background: green squares that follow the mouse ----------
     The faint grid is drawn once and cached; each frame only repaints lit squares.
     Animation runs only on mouse devices, after the page has loaded, while the hero is on screen. */
  const canvas = d.querySelector('.fx-grid');
  const fine = matchMedia('(hover: hover) and (pointer: fine)').matches;
  if (canvas && canvas.getContext && !reduce) {
    const host = canvas.parentElement;
    const ctx = canvas.getContext('2d');
    const CELL = 26, GAP = 4, RADIUS = 3;
    let cols = 0, rows = 0, heat = new Float32Array(0), lit = new Set(), base = null, dpr = 1, running = false, visible = true, last = 0;
    const size = () => {
      dpr = Math.min(window.devicePixelRatio || 1, 2);
      const w = host.clientWidth, h = host.clientHeight;
      canvas.width = w * dpr; canvas.height = h * dpr;
      cols = Math.ceil(w / CELL); rows = Math.ceil(h / CELL);
      heat = new Float32Array(cols * rows); lit = new Set();
      base = document.createElement('canvas'); base.width = canvas.width; base.height = canvas.height;
      const b = base.getContext('2d'); b.setTransform(dpr, 0, 0, dpr, 0, 0); b.fillStyle = 'rgba(255, 255, 255, 0.025)';
      for (let y = 0; y < rows; y += 1) for (let x = 0; x < cols; x += 1) b.fillRect(x * CELL + GAP / 2, y * CELL + GAP / 2, CELL - GAP, CELL - GAP);
      ctx.setTransform(1, 0, 0, 1, 0, 0); ctx.drawImage(base, 0, 0);
    };
    const light = (i, v) => { if (v > heat[i]) { heat[i] = v; lit.add(i); } };
    const draw = (t) => {
      if (!visible) { running = false; return; }
      if (t - last > 160) { last = t; light((Math.random() * heat.length) | 0, 0.35); }
      ctx.setTransform(1, 0, 0, 1, 0, 0); ctx.clearRect(0, 0, canvas.width, canvas.height); ctx.drawImage(base, 0, 0);
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
      lit.forEach((i) => {
        const v = heat[i];
        if (v < 0.01) { heat[i] = 0; lit.delete(i); return; }
        ctx.fillStyle = `rgba(20, 203, 148, ${(0.035 + v * 0.38).toFixed(3)})`;
        ctx.fillRect((i % cols) * CELL + GAP / 2, ((i / cols) | 0) * CELL + GAP / 2, CELL - GAP, CELL - GAP);
        heat[i] = v * 0.94;
      });
      requestAnimationFrame(draw);
    };
    const kick = () => { if (fine && !running && visible) { running = true; requestAnimationFrame(draw); } };
    const start = () => {
      size();
      if (!fine) return; // touch devices get the static grid only
      host.addEventListener('pointermove', (e) => {
        const r = host.getBoundingClientRect();
        const cx = Math.floor((e.clientX - r.left) / CELL), cy = Math.floor((e.clientY - r.top) / CELL);
        for (let y = -RADIUS; y <= RADIUS; y += 1) {
          for (let x = -RADIUS; x <= RADIUS; x += 1) {
            const gx = cx + x, gy = cy + y, dist = Math.hypot(x, y);
            if (gx < 0 || gy < 0 || gx >= cols || gy >= rows || dist > RADIUS) continue;
            light(gy * cols + gx, 1 - dist / (RADIUS + 0.5));
          }
        }
        kick();
      }, { passive: true });
      new IntersectionObserver(([en]) => { visible = en.isIntersecting; kick(); }).observe(host);
      let rt; window.addEventListener('resize', () => { clearTimeout(rt); rt = setTimeout(size, 150); }, { passive: true });
      kick();
    };
    const later = () => (window.requestIdleCallback ? requestIdleCallback(start, { timeout: 2000 }) : setTimeout(start, 600));
    if (d.readyState === 'complete') later(); else window.addEventListener('load', later, { once: true });
  }

  if (granted()) startTracking();
})();
