# File plan and architecture

No build step. PHP 8.x includes for shared parts, one CSS file (inlined and minified at runtime, cached in storage), two small vanilla JS files. Upload and it runs.

As built (28 Oct 2026): see `docs/deploy.md` for running locally and going live.

## 1. Tree

```
Studio-Key/
├── CLAUDE.md                     Project rules for Claude sessions
├── .gitignore                    Ignores app/secrets.php, storage/*
├── .claude/skills/studio-key-hosting/SKILL.md
├── docs/                         PRD and reference docs (never deployed)
│
├── app/                          OUTSIDE the web root
│   ├── bootstrap.php             Loads config, sets security headers, helpers (e(), asset(), url()), defines SK_APP
│   ├── config.php                Site globals: name, NAP, phone, prices, nav, towns, GA4 ID, collector URL, env (dev/live)
│   ├── secrets.example.php       Template: Brevo API key, list ID, form HMAC secret
│   ├── secrets.php               Real values, never committed
│   ├── content/
│   │   └── faqs.php              FAQ arrays reused by pages and FAQPage schema
│   ├── partials/
│   │   ├── head.php              <head>: meta, canonical, OG, preloads, CSS, consent defaults
│   │   ├── header.php            Logo, nav, phone, "Let's talk"
│   │   ├── footer.php            Footer, legal line, mobile sticky bar, scripts
│   │   ├── schema.php            JSON-LD builder per page
│   │   ├── consent.php           Cookie banner markup
│   │   ├── trust-logos.php       Logo strip
│   │   ├── cta-band.php          Reusable end-of-page CTA
│   │   ├── faq.php               FAQ list (details/summary, no JS needed)
│   │   ├── enquiry-form.php      3-step form, shared by Home and Contact
│   │   └── icons.php             Inline Phosphor SVGs: icon('shield-check')
│   └── lib/
│       ├── form.php              Validation, honeypot, time trap, HMAC token, rate limit
│       └── brevo.php             Brevo API calls (contact upsert, transactional emails)
│
├── storage/                      OUTSIDE the web root, writable by PHP
│   ├── ratelimit/                Hashed-IP counters
│   └── leads/                    Fallback log if Brevo is down
│
├── public/                       WEB ROOT (point CloudPanel here)
│   ├── index.php                 Home
│   ├── pricing/index.php
│   ├── about/index.php
│   ├── contact/index.php
│   ├── privacy/index.php
│   ├── terms/index.php
│   ├── 404.php
│   ├── api/enquiry.php           POST only. Validates, calls Brevo, returns JSON or redirects (no-JS)
│   ├── robots.txt
│   ├── sitemap.xml
│   ├── favicon.svg, favicon.ico, apple-touch-icon.png
│   └── assets/
│       ├── css/site.css          Tokens, base, layout, components, utilities (one file)
│       ├── js/main.js            Consent banner, consent-gated event layer (dataLayer + optional beacon), GA4 loader, UTM capture, sticky bar, menu fallback
│       ├── js/form.js            Step logic, validation, fetch submit
│       ├── fonts/                Satoshi-Variable.woff2, Satoshi-VariableItalic.woff2
│       ├── img/                  logo.svg, rich.webp, og.jpg, logos/*.svg, video-poster.webp
│       └── video/                sales-letter.mp4, sales-letter.en.vtt
│
└── deploy/
    ├── nginx-site.conf           Snippets for the CloudPanel vhost: headers, denies, trailing slash, 404
    └── redirects.conf            Old URL to new URL 301s
```

Each page file is short:

```php
<?php
require __DIR__ . '/../../app/bootstrap.php';
$page = ['id' => 'pricing', 'title' => '...', 'description' => '...', 'path' => '/pricing/'];
include APP . '/partials/head.php';
include APP . '/partials/header.php';
?>
<main id="main"> ...page sections... </main>
<?php include APP . '/partials/footer.php';
```

If the host cannot point the web root at `public/`, fallback: everything sits in the root and `app/` and `storage/` are blocked by Nginx rules plus a `defined('SK_APP') || exit;` guard at the top of every include.

## 2. Globals (`app/config.php`)

One place for anything that appears in more than one spot: business name, legal name, company number, registered office, phone (display and `tel:` format), WhatsApp link, email, service-area towns, prices, nav items, GA4 ID, collector URL, environment flag. Pages and schema read from here, so a price change is a one-line edit.

## 3. CSS

- One file, ordered: tokens (`:root` colours, spacing, type scale, radius), reset, base typography, layout (container, grid, stack), components (button, card, list, form, video frame, logo strip, FAQ, sticky bar, banner), utilities.
- Mobile first. Two breakpoints: 48rem, 64rem.
- Colours captured from studio-key.co.uk once the domain is reachable.

## 4. JavaScript

- No frameworks, no libraries. ES modules with `defer`. Target under 20 KB total.
- Site works with JS off: nav is a plain list, form submits as one page, FAQs use `<details>`.
- The event layer in `main.js` does nothing until consent is given.

## 5. Security

| Area | Measure |
|---|---|
| Code exposure | `app/`, `storage/`, `docs/`, `.git` never web-reachable. Includes guarded by `SK_APP` |
| Secrets | `app/secrets.php` only, git-ignored, file mode 600 |
| Errors | `display_errors=0` live, errors to the PHP-FPM log |
| Headers (PHP and Nginx) | HSTS, CSP (self + GA4 domains + `app.greenweb.org` for the badge image only, no inline script except a nonce'd consent default), `X-Content-Type-Options: nosniff`, `Referrer-Policy: strict-origin-when-cross-origin`, `Permissions-Policy` (camera, mic, geolocation off), `frame-ancestors 'none'` |
| Output | Every dynamic value through `e()` (`htmlspecialchars`, ENT_QUOTES, UTF-8) |
| Form | POST only, same-origin check, stateless HMAC token with timestamp (cache-safe behind Cloudflare, no session cookie), honeypot, 3-second time trap, length limits, email validation, rate limit 5/hour per hashed IP, header-injection safe |
| Brevo | Server-side only, key never sent to the browser. 5-second timeout, fallback lead log |
| Uploads | None |
| Dependencies | None. Nothing to patch except PHP |
| Privacy | IPs hashed with a salt for rate limiting, not stored raw. Privacy notice covers Brevo, GA4 and first-party events |

## 6. Tracking tags (for the future dashboard)

Stable attribute names. Do not rename once live: the dashboard will key on them.

| Attribute | On | Example |
|---|---|---|
| `data-page` | `<body>` | `home`, `pricing`, `about`, `contact` |
| `data-section` | each `<section>` | `hero`, `problems`, `plans`, `enquiry` |
| `data-cta` | every CTA link/button | `hero-primary`, `hero-pricing`, `header-talk`, `sticky-call` |
| `data-contact` | outbound contact links | `phone`, `whatsapp`, `email` |
| `data-form` / `data-step` | form and each step | `enquiry` / `1`, `2`, `3` |
| `data-video` | video element | `sales-letter` |
| `data-faq` | each FAQ item | slug of the question |
| `data-review` | each review | `ryan-young` |

Event shape pushed to `dataLayer` and the collector:

```json
{ "event": "cta_click", "page": "home", "section": "hero", "id": "hero-primary",
  "ts": 1730131200000, "session": "random-first-party-id", "utm_campaign": "autumn-email" }
```

Event names: `page_view`, `section_view`, `scroll_depth`, `dwell`, `cta_click`, `contact_click`, `video_play`, `video_progress`, `video_complete`, `form_step_view`, `form_step_complete`, `form_submit`, `form_error`, `faq_open`, `review_expand`.

## 7. Build order

1. `app/bootstrap.php`, `config.php`, partials, `site.css` tokens and base.
2. Home with locked copy and video placeholder.
3. Enquiry form front end, then `api/enquiry.php` with Brevo.
4. Pricing, About, Contact, Privacy, Terms, 404.
5. Schema, meta, sitemap, robots.
6. `track.js`, consent banner, GA4.
7. `deploy/` Nginx snippets and redirects.
8. QA: Lighthouse, keyboard pass, screen reader spot check, form spam tests, no-JS pass, 360px to 1440px screenshots.
