# Deploy and go-live

No build step. Upload files and they run.

## Preview locally

```bash
php -S localhost:8080 -t public deploy/dev-router.php
```

Open http://localhost:8080. Enquiries go to `storage/leads/` when mail isn't set up.

## Preview on cPanel / LiteSpeed (new.studio-key.co.uk)

Every push to the default branch uploads the site by FTPS (`.github/workflows/deploy-preview.yml`). Run it by hand from the Actions tab to deploy any branch.

One-time setup:
1. cPanel > Domains > Create a new domain: `new.studio-key.co.uk`. Untick "Share document root" and set the document root to `new.studio-key.co.uk/public`.
2. cPanel > FTP Accounts: create an account whose directory is `new.studio-key.co.uk` (not `public`). It can only touch the preview.
3. GitHub > Settings > Secrets and variables > Actions: add `FTP_SERVER`, `FTP_USERNAME`, `FTP_PASSWORD`. If the first run fails on TLS, add a variable `FTP_PROTOCOL` = `ftp`.
4. Cloudflare DNS: an A record for `new` pointing at the server, proxied. cPanel AutoSSL then issues the certificate.
5. Actions tab > Deploy preview > Run workflow.

The preview is noindexed automatically (`app/config.php` treats `new.` and `dev.` hosts as dev). `public/.htaccess` carries the LiteSpeed rules; `app/`, `storage/` and `deploy/` each deny web access as a backstop. The signing key writes itself to `storage/app.key` on first use, so no `secrets.php` is needed until Brevo goes in. Enquiries from the preview are real: they reach help@ and the lead log.

## First deploy (CloudPanel)

1. Create the site (PHP 8.2+). Set the **root directory** to `.../public`.
2. Upload `app/`, `public/`, `storage/` and `deploy/` (FileZilla or `git pull`). Don't upload `docs/` or `.claude/`.
3. Copy `app/secrets.example.php` to `app/secrets.php`, fill in `app_key` (`php -r "echo bin2hex(random_bytes(32));"`), then `chmod 600 app/secrets.php`.
4. Make `storage/` writable by the PHP user (`chmod -R 750 storage`, owned by the site user).
5. Paste `deploy/nginx-site.conf` into the Vhost Editor. Reload Nginx.
6. Purge the Cloudflare cache.

## Dev copy first

- Use `dev.studio-key.co.uk` with CloudPanel basic auth on.
- Add `fastcgi_param SK_ENV dev;` in the vhost. Pages then send `noindex`.

## Go-live checklist

- [ ] Rich has approved all new copy, prices and terms
- [ ] `deploy/redirects.conf` filled from the old sitemap and included in the vhost
- [ ] `SK_ENV` removed (live) and `noindex` gone (view source on the home page)
- [ ] Test enquiry received at help@studio-key.co.uk (and in Brevo once keys are in)
- [ ] Form tested on a real iPhone and Android phone
- [ ] Sitemap submitted in Google Search Console
- [ ] Old URLs spot-checked for 301s
- [ ] Cloudflare cache purged
- [ ] Lighthouse run on the live URL (mobile and desktop)

## Later switches (all in `app/config.php` or `app/secrets.php`)

| Item | Where | Effect |
|---|---|---|
| GA4 ID | `config.php` `ga4_id` | GA4 loads after cookie consent, CSP allows Google |
| Tracking dashboard collector | `config.php` `collector_url` | Events also sent by `sendBeacon` |
| Brevo | `secrets.php` | Contacts and emails go through Brevo |
| Google reviews link | `config.php` `reviews_url` | Adds a "see all reviews" link |
| Primary CTA test | `config.php` `cta_primary` | Changes every primary button |
| Hero video | `public/assets/video/sales-letter.mp4`, poster `public/assets/img/video-poster.webp`, captions `sales-letter.en.vtt` | Placeholder swaps for the video automatically |
| Rich's photo | Replace `.photo-placeholder` in `public/about/index.php` | |

After changing CSS or JS, nothing else is needed: file timestamps bust the cache.
