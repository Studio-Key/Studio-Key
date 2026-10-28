---
name: studio-key-hosting
description: Studio Key website hosting knowledge base. What web hosting is in plain English, what Rich does, the offer, prices, customer pains, approved claims, banned claims and tone of voice. Load before writing any copy, page, FAQ, email, meta tag or schema for Studio Key, and before any decision about the Studio Key website.
---

# Studio Key hosting knowledge base

Use this as the source of truth for anything about Studio Key hosting. If this file conflicts with `docs/PRD.md`, the PRD wins. If either is silent, ask Rich. Never invent facts, figures, reviews or certifications.

## 1. Who Studio Key is

- Rich, an independent website hosting provider. One named person, not a team.
- Trading entity: RMD Trading Limited (company no. 11656826), trading as Studio Key. Registered office: 44 Furlong Close, Weldon, NN17 5AW (footer legal line only).
- Server: Hetzner (green hosting, verified by the Green Web Foundation).
- Public location wording: "Based in Corby, serving the East Midlands".
- Looks after 110+ business websites.
- Hosting is the main service. Rich also builds websites and does ongoing maintenance (secondary, mention lightly).
- Phone and WhatsApp: 07356 171658. Email: help@studio-key.co.uk.
- Not VAT registered. Never show VAT.

## 2. Web hosting in plain English (for explaining to customers)

Rich splits every website into three parts and explains each in turn. Copy should do the same.

| Part | Plain-English explanation |
|---|---|
| Hosting | The computer (server) your website lives on, switched on 24/7 so people can visit it. |
| Domain | Your web address, e.g. yourbusiness.co.uk. You rent it yearly from a registrar. |
| Email | Your @yourbusiness.co.uk inbox. Often sits with Microsoft 365, Google Workspace or the old host. Always check email first before moving anything. |
| SSL certificate | The padlock in the browser. Keeps visitors' data private and stops "Not secure" warnings. Free with Studio Key, for life. |
| DNS | The signposts that point your domain at your hosting and email. |
| Backups | A copy of your website kept somewhere else, so it can be restored if something breaks. Studio Key backs up daily to Amazon AWS S3. |

Useful Rich analogies (reuse the idea, tidy the wording):
- A temporary fix is "a plaster over the wound".
- Plugins are "jigsaw pieces".
- An unsupported theme means "in human terms, there's no support for it".

## 3. The offer (confirmed)

| Item | Price | Notes |
|---|---|---|
| Standard hosting | £119 a year, all-inclusive | Free SSL for life, no domain-protection fees, no annual SSL billing, daily AWS S3 backups, uptime monitoring, direct support from Rich |
| Managed hosting | £450 a year | Everything in Standard, plus Rich keeps WordPress, plugins and themes updated |
| .co.uk / .uk domain | £14 a year | Only where Studio Key registers it |
| .com domain | £22 a year | Only where Studio Key registers it |
| Support, fixes, changes | £65 an hour | Rich quotes time up front |
| Moving your site to Studio Key | Free | Rich does the migration |
| Leaving | No lock-in | 30-day money-back on new plans, then one month's notice with unused full months refunded, free full backup to take away (PRD 7.3, confirmed) |

Customers keep their existing domain and website. Rich never pushes a domain transfer: "I never recommend moving a domain provider" unless there is a real gain for the customer.

## 4. How Rich delivers it

1. Quick chat (phone, WhatsApp, Teams/Zoom or in person) to understand the site, the email and who holds the domain.
2. Rich takes a backup and a copy from the old host.
3. He tests the site on a private staging copy first.
4. He switches the DNS, often on a call with the customer so they see it happen.
5. He confirms everything works, email included, and only then tells the old host to cancel.
6. After that, the customer deals with Rich directly. Same-day replies are normal.

Rich meets local clients in person to set up hosting when useful.

## 5. Who the customer is and what hurts

Local business owners across the East Midlands, mostly not technical. Sectors seen: insurance brokers, trades, cleaning, training providers, logistics, hospitality and venues, consultancies, holiday lets, recruitment, couriers, homebuilders, industrial suppliers.

Towns: Corby, Kettering, Wellingborough, Northampton, Market Harborough, Oakham, Stamford, Leicester, Peterborough.

Pains (use these, in the customer's words where possible):
- Surprise yearly SSL and "domain protection" charges (£79+). Real example: a third-party "renewal notification" invoice for £178.
- Paying more than they should.
- Not knowing who hosts the site, the email or the domain.
- No sense of owning their own website. An old agency still listed as the admin.
- Old hosts dropping small sites and leaving them "in limbo".
- Neglected sites: out-of-date PHP, unsupported themes, spam piling up.
- Missing or unreliable backups.
- Support queues and call centres.

Transformation: from confused, overcharged and ignored, to one clear yearly price, a site they own, daily backups and a person who answers.

## 6. Claims

Approved (true, evidenced):
- 110+ business websites hosted.
- Free SSL certificates for life.
- Daily backups to Amazon AWS S3.
- No hidden costs. Prices as in section 3.
- Direct support from Rich, no call centre.
- Free migration. Keep your existing domain and website.
- Private server, managed by Rich. (Do not say "Nginx" or "UK" in public copy: the estate is mixed and the main site sits on Hetzner, which has no UK data centres. Rich to confirm.)
- Green hosting, verified by the Green Web Foundation (live badge: `https://app.greenweb.org/api/v3/greencheckimage/www.studio-key.co.uk?nocache=true`, links to the Green Web Check).
- 5-star Google reviews (three reviews in PRD 8.1; no count until Rich supplies it).
- Free migration, scope as PRD 7.1. Most moves go unnoticed by visitors (never "zero downtime").
- Backups stored on Amazon Web Services.

Banned:
- "Google certified" or any Google Partner badge.
- "AWS Partner" or anything implying an AWS partnership.
- "Zero downtime", "best hosting", uptime percentages, speed figures or response-time guarantees Rich has not confirmed.
- Server IPs, hostnames, reseller names, staging URLs, bank details, passwords.
- Overstone, Azzurri, property-sector content, billing-recovery figures.
- Customer names or quotes without written permission.
- Self-serving review schema (AggregateRating on our own business).

## 7. Tone of voice (summary, full guide in docs/voice-and-customers.md)

- First person "I". Never "we" in site copy.
- British English. Plain, warm, a bit informal. Short sentences.
- Reassurance first, then the detail. Tell people what they don't need to do.
- On the customer's side. Honest about what he does and doesn't control.
- Prices stated up front.
- No em dashes. No "actually". No adverbs unless removing one changes the meaning. No rule-of-three padding. No binary contrasts ("not X, it's Y"). Active voice.
- Never write "discovery call". Use "15-minute call" or "quick chat".
- Primary CTA everywhere: "See your options" (label set in config, may change after testing). Secondary: "See my prices". Contextual: "Get a free hosting check", "Moving from another host?".
- Speak to first-time buyers as well as people moving from another host. Contact: "Call me", "WhatsApp me", "Send me a message".
- Plain English. No jargon above the fold (NVMe, LiteSpeed, PHP workers, Nginx).
- Order: outcome, benefits, proof, detail.

Before shipping any copy, run it through the stop-slop and humanizer checks.
