# SEO plan

Organic CTR is the gating metric: titles and descriptions come first. Keyword volumes are still pending; the clusters below are the working set until GSC and a volume tool confirm them.

## Keyword clusters

| Cluster | Example terms | Target page |
|---|---|---|
| Regional | website hosting East Midlands, web hosting Northamptonshire | Home |
| Town | website hosting Corby, web hosting Kettering, website hosting Northampton | Home now, town pages later |
| Price intent | cheap website hosting UK small business, website hosting cost, hosting with free SSL | Pricing |
| Switching | move website to new host, change website hosting, transfer WordPress hosting | Home (how it works), FAQs |
| Person / trust | local web hosting company, independent website hosting UK | About |

Gap to exploit: Netmatters targets Norfolk and Cambridgeshire, not the East Midlands.

## Meta

| Page | Title (under 60 chars) | Description (under 155 chars) |
|---|---|---|
| Home | Website Hosting East Midlands, No Hidden Fees \| Studio Key | Personal website hosting from Rich in Corby. £119 a year with free SSL for life, daily AWS backups and support from a real person. |
| Pricing | Website Hosting Prices, £119 a Year \| Studio Key | One clear yearly price. Free SSL, daily backups and free migration included. No VAT, no domain protection fees, no surprises. |
| About | About Rich, Your Local Website Host \| Studio Key | I'm Rich, an independent hosting provider in Corby looking after 110+ business websites across the East Midlands. |
| Contact | Contact Rich in Corby \| Studio Key | Call, WhatsApp or send a message. I reply the same day or the next working day. Based in Corby, serving the East Midlands. |

All drafts: Rich approves. Each page also gets a canonical URL, Open Graph and Twitter card tags with a shared OG image.

## Structured data (JSON-LD)

| Page | Types |
|---|---|
| All | `Organization` (name, legal name, logo, phone, email, `sameAs` Google profile), `WebSite` |
| Home | `ProfessionalService` with `areaServed` (towns list + East Midlands), `address` locality Corby only, `priceRange` "£119 to £450", `VideoObject` once the video exists |
| Pricing | `Service` with two `Offer`s (GBP, yearly), `FAQPage` |
| About | `Person` (Rich, `worksFor` Studio Key), `AboutPage` |
| Contact | `ContactPage` |

No `AggregateRating` on our own business (Google ignores self-serving reviews and it risks a manual action).

## On-page rules

- One H1 per page, containing the main term where it reads naturally.
- Town names in body copy, About areas list and footer service area. No keyword stuffing.
- Descriptive alt text on Rich's photo and logos. Video gets captions and a transcript summary.
- Internal links: every page links to Pricing and Contact. FAQ answers link to Pricing where relevant.
- Statistics trace to original non-competitor sources, caveats inline.

## Technical

- Clean folder URLs with trailing slash (`/pricing/`). Nginx 301s the non-slash form.
- `https://www.studio-key.co.uk` or the bare domain: pick one (match the current indexed version) and 301 the other.
- Static `sitemap.xml` and `robots.txt` in `public/`. Dev site sends `X-Robots-Tag: noindex`.
- Core Web Vitals: hero poster image preloaded and sized, font preloaded, JS deferred, no layout shift from the video frame (fixed aspect ratio).

## Redirects (launch)

The current site has about 40 pages. Before go-live:
1. Pull the sitemap and the GSC "Pages" report.
2. Map each URL to the closest new page in `deploy/redirects.conf` (Nginx `location = /old/ { return 301 /new/; }`).
3. Anything with backlinks or traffic and no close match gets flagged to Rich; it may justify a future page.
4. After launch, watch GSC for 404s weekly for a month.

## Later (not this build)

- Town landing pages (Corby, Kettering, Northampton) with unique local content.
- Google Business Profile reinstated as a service-area business with consistent NAP.
- Review generation routine after each migration.
