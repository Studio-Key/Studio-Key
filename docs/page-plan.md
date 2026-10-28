# Page plan and CRO

Section order, purpose and tags for each page. `data-section` values are the tracking IDs (see `docs/file-plan.md`, section 6). "LOCKED" means the copy comes verbatim from `docs/PRD.md`, section 5.

## Global

| Area | Contents |
|---|---|
| Header | Logo (home link), nav: Pricing, About, Contact. Phone number (click to call). "See your options" button |
| Mobile header | Logo, menu button, phone icon |
| Mobile sticky bar | Call, WhatsApp, See your options. Hidden once the form is on screen |
| Footer | Short line about Rich, nav, phone, WhatsApp, email, "Based in Corby, serving the East Midlands", privacy and terms links, legal line (company no. 11656826) |
| Consent banner | Accept / Reject, plain wording, link to `/privacy/` |

## Home `/`

Primary goal: start the form or call. Secondary: visit Pricing.

| # | `data-section` | Content | CRO note |
|---|---|---|---|
| 1 | `hero` | Left: H1, intro (LOCKED), "See your options" button + "See my prices" text link, micro-proof line "5-star Google reviews · 110+ business websites · Corby, East Midlands". Right: 5:4 video | Price and proof above the fold for Google visitors; video for email visitors |
| 2 | `trust` | Logo strip: Green Web Foundation live badge, Powered by AWS, 5-star Google reviews | Small, honest captions |
| 3 | `qualifier` | H2 + two paragraphs (LOCKED) | Ends on "let's talk": add "See your options" button and "or get a free hosting check" link |
| 4 | `promise` | H2 + 3 callouts with Phosphor icons (LOCKED) | |
| 5 | `problems` | "Sound familiar?" list (LOCKED) | Two-column on desktop |
| 6 | `solutions` | "A more straightforward approach" list + keep-your-domain line (LOCKED) | Sits beside or after problems for before/after contrast |
| 7 | `how-it-works` | New copy: 4 steps (chat, I copy and test, we switch together, you deal with me) | Removes fear of moving. Mentions free migration. Short second path: "New to hosting? I set everything up for you" |
| 8 | `price-teaser` | "£119 a year. Under £10 a month, nothing added on." What's in, renewal price, link to Pricing | Anchors on the real price |
| 8b | `reassurance` | Risk reversal: what free migration covers, 30-day money-back, free backup if you leave, who looks after what (short, links to Pricing) | Loss aversion, specific assurances |
| 9 | `testimonials` | Three Google reviews (PRD 8.1): pull line, stars, name, "Read more" expands | Specific, not a wall |
| 10 | `faq` | 5 objection FAQs: domain, email, downtime during the move, leaving, what if something breaks | Pulled from `app/content/faqs.php` |
| 11 | `enquiry` | Short intro from Rich with photo, 3-step form, phone and WhatsApp beside it | Final conversion point for long scrollers |

## Pricing `/pricing/`

Primary goal: confidence in the price, then contact.

| # | `data-section` | Content |
|---|---|---|
| 1 | `pricing-hero` | H1, one-line promise: the price you see is the price you pay |
| 2 | `plans` | Two cards: Standard £119/yr (marked "Most businesses"), Managed £450/yr. Each lists what's included and a CTA |
| 3 | `included` | Who looks after what table (PRD 7.4) |
| 4 | `extras` | Domains (.co.uk £14, .com £22), support £65/hr quoted up front, migration free |
| 5 | `compare` | "What you might be paying now": typical extras big hosts add (SSL, domain protection, backups add-ons). Facts only, sourced |
| 5b | `terms` | Plain-English terms: billing yearly in advance, renewal price, 30-day money-back, leaving, migration scope and exclusions |
| 6 | `faq` | Pricing FAQs: billing, VAT, leaving, domains, renewals |
| 7 | `cta` | CTA band with phone and form link |

## About `/about/`

Primary goal: trust in Rich as a person.

| # | `data-section` | Content |
|---|---|---|
| 1 | `about-hero` | H1, photo of Rich, two-line intro |
| 2 | `story` | Rich's story (lorem ipsum until Rich supplies it) |
| 3 | `how-i-work` | In person or on a call, free migration, test first, same-day replies, honest advice (e.g. "I never recommend moving a domain provider unless it saves you money") |
| 4 | `areas` | Areas served: Corby, Kettering, Wellingborough, Northampton, Market Harborough, Oakham, Stamford, Leicester, Peterborough |
| 5 | `also` | Short note: I also build and look after websites |
| 6 | `cta` | CTA band |

## Contact `/contact/`

Primary goal: submit the form or call.

| # | `data-section` | Content |
|---|---|---|
| 1 | `contact-hero` | H1, one line on what happens next and how fast |
| 2 | `enquiry` | 3-step form (left), contact card (right): phone, WhatsApp, email, photo, service area |
| 3 | `next-steps` | What happens after you get in touch, 3 short steps |

## CRO checklist (all pages)

- One primary CTA per section. Same wording everywhere ("See your options", label from config). Secondary actions are quiet text links.
- Phone number visible without scrolling on every page.
- Price visible on Home within two scrolls.
- No carousels, no pop-ups, no exit intent.
- Form starts with an easy question (step 1 is one click).
- Proof sits next to every ask (reviews line by hero CTA, photo by the form).
- Email campaign links land on `/` with UTMs; no separate landing page needed at launch.
