# Studio Key: Hosting Business Website PRD

Reference document for Claude Code. Build the Studio Key website from this file. Where this file is silent or conflicts with the code, stop and ask Rich.

---

## 1. Overview

- Studio Key is the hosting, development and maintenance brand run by Rich Devenport.
- Trading entity: RMD Trading Limited, trading as Studio Key. (Azzurri Designs Limited is dissolved and merged into RMD Trading Limited. Azzurri survives only as a trading name, RMD t/a Azzurri. Do not reference Azzurri on the Studio Key site.)
- Location: Corby, Northamptonshire. Serves local businesses across the East Midlands.
- Client base: 110+ local business websites hosted.
- Primary goal: win and retain small local business hosting clients who are unhappy with large registrars or hosts.
- Positioning: honest, transparent, personal. Rich is a named human who answers the phone. Not a faceless provider.

---

## 2. Target audience

- Local business owners in the East Midlands (SME scale).
- Current pain points they feel:
  - Unexpected yearly SSL and "domain protection" fees (often £79+)
  - Feeling overcharged for hosting
  - Confusing website management
  - No sense of owning their website
  - Unreliable or missing backups
  - Slow, impersonal support
- Secondary segment: UK agencies seeking white-label hosting under the Studio Key brand (see section 9).

---

## 3. Services and pricing

### Hosting tiers (confirmed Sept 2026)

| Tier | Price | Inclusions |
|---|---|---|
| Standard | £119/yr, all-inclusive | Free SSL for life, no domain-protection fees, no annual SSL billing, private VPS, daily S3 backups |
| Managed (cross-sell) | £450/yr | Fully managed, private VPS, daily S3 backups, named human support |

- The all-inclusive framing is the main differentiator against big registrars and hosts.
- Managed tier sits at the top of the UK agency-managed band (£250 to £450/yr). Keep the price.

### Domain pricing (Studio Key-registered domains, where applicable)

- .co.uk / .uk: £14/yr (raised from £13). Teaser brands renew at £14.39 to £16 inc-VAT.
- .com: £22/yr. Hold here. Do not raise.
- Registrar cost is roughly £4 to £5 (.co.uk) and £8 (.com) via Cloudflare or Guru.

### Other service facts

- Keep your current domain: clients can keep the domain they already own.
- Fast, reliable Nginx private server.
- Studio Key also offers web design and development, and ongoing maintenance.
- Hosting is the primary service. Rich meets clients in person to set up their hosting.

### Billing rules (hard rule)

- A client paying regularly for any service does not mean their domain is billed.
- Coverage must be evidenced by a Zoho Invoice line item that names the specific domain.
- Do not raise an invoice on the basis of a formula. Only a raised unpaid invoice is billable.

### Not VAT registered

- Do not show VAT on prices. Prices are as stated above.

---

## 4. Tech stack

Stack for the Studio Key site (from prior decisions):

- React 18
- Vite
- TypeScript
- Tailwind CSS
- shadcn/ui
- React Router DOM

Design layer:

- IBM Carbon Design System, CSS layer only, framework-agnostic
- Satoshi variable font, self-hosted (woff2)
- Phosphor icons, downloaded locally and inlined. Do not load from a CDN.
- shadcn/ui components

Conflict to resolve (see section 15): Rich's general preference is pure PHP, HTML, CSS and vanilla JS with YAGNI, and no build tools unless the task needs them. The Studio Key stack above was chosen deliberately for this site. Follow the stack above unless Rich says otherwise.

### Local screenshot QA

- Use `lshot.mjs`, not `shot.mjs`. It resolves absolute paths and aborts Google Fonts requests to stop stalls.

---

## 5. Hosting infrastructure (for copy accuracy)

These details inform site copy only. Do not publish server IPs, hostnames or credentials on the site.

- Hostinger VPS, CloudPanel, Nginx, Varnish, PHP-FPM
- Daily backups to Amazon AWS S3
- Free SSL certificates (for life, included in hosting price)
- Cloudflare DNS for Studio Key
- Fail2Ban on the server
- Google Search Console and RankMath used for SEO monitoring

---

## 6. Site structure

- Full site: 40 pages (per prior record). Confirm with Rich whether this is a rebuild or a new build (see section 15).
- Homepage copy is verbatim-locked (section 7).
- Meta title format: `Page Topic | Studio Key`
- Candidate homepage title for testing: `East Midlands Website Hosting (No Hidden Fees)`. Confirm before use, since it does not follow the standard format.
- Target keyword clusters: East Midlands website hosting and related local terms. Keyword volume data is still pending.

### SEO rules

- CTR from organic search results is the gating metric. Prioritise meta titles and descriptions before on-page content work.
- Statistics must trace to original, non-competitor sources, with caveats stated inline.
- Competitor Netmatters targets Norfolk and Cambridgeshire in its titles, not the East Midlands. This is a gap to exploit.

---

## 7. Verbatim homepage copy (locked)

Use this copy exactly as written. Do not paraphrase, reword or trim it.

**H1:** Local and personal website hosting

**Intro:** I'm Rich and I give over 110 local business websites a reliable and affordable place to live, with no hidden costs and personal support from me here in the East Midlands.

**Qualifying section:** If you're happy with your current website hosting provider being uncontactable, you suspect is a bit too expensive, has surprise yearly fees, and feels impersonal - then I'm not for you. But if you're after an easy to understand, honest website host you can speak to without waiting in a queue - let's talk.

**Subheading:** Supporting you run your business reliably

**Callout bullets:** No hidden costs | Free SSL certificate for life | Daily backups (Amazon AWS S3)

**Common problems:**
- 💸 Unexpected £79+ yearly SSL and 'domain protection' fees
- 💸 Feeling overcharged for services
- ❌ Confusing website management
- ❌ No sense of ownership
- ⚠️ Unreliable or missing backups
- ⚠️ Slow, impersonal support

**My solutions:**
- ✅ Transparent pricing
- ✅ Free SSL coverage for life
- ✅ Complete ownership of your site
- ✅ Automatic, secure backups
- ✅ UK based support, always
- ✅ Consultancy focused around your business

**Additional notes:** Keep your current domain | Fast reliable Nginx private server

Open items on this copy (see section 15): the spaced hyphen in the qualifying section, and the grammar of "you suspect is a bit too expensive".

---

## 8. Copy standards (apply to all site copy)

- British English throughout (EN-GB spelling). Never American sales language.
- First person "I". Never "we".
- No em dashes, ever.
- No adverbs, unless removing them changes the meaning.
- No rule-of-three padding lists.
- No vague declaratives unsupported by a specific fact.
- No binary-contrast constructions.
- Active voice throughout.
- Never write "discovery call". Use "fit call" or "15-minute call".
- Never use "actually" or other AI-style filler.

### Approved CTA copy only

- "Talk to Us"
- "Run your project past us"
- "Pick a slot"

Do not use "Book a discovery call" or any other CTA wording.

### Property-sector vocabulary (for Overstone only, not Studio Key)

- Do not use this section on the Studio Key site. It is recorded here so it is not applied by mistake.

---

## 9. White-label and agency growth

- Studio Key offers white-label hosting under its brand to UK agencies.
- Growth goal: take the hosted-site count from 105 to 220 through agency partnerships.
- Research and cold email sequences exist for UK agency outreach.
- Build an agency-facing page separate from the main hosting pages if needed. Confirm the approach with Rich first.

---

## 10. Google Business Profile and local presence

- The Studio Key Google Business Profile was disabled. The appeal was not approved. Reinstatement is being pursued.
- Plan: rework the listing as a service-area business.
- Rich meets clients in person to set up hosting. Rich is happy to remove his home address from the listing.
- The site should carry consistent NAP details (name, address, phone) once confirmed. Confirm which address and phone number to show, since the home address is to be removed.

---

## 11. Contact and call-to-action

- Primary CTA: "Talk to Us" or "Pick a slot" (see section 8).
- The prior calendar link (`calendly.com/_overstone/30min`) belongs to Overstone. Do not use it on the Studio Key site without confirmation. Ask Rich for a Studio Key scheduling link.
- Rich prefers a direct, personal tone. The site should read as a human writing to a human.

---

## 12. Analytics and reporting

- Google Search Console: active for monitoring.
- A custom GSC reporting system exists at `workshop.studio-key.co.uk/reporting/`. It is internal. Do not link it from the public site.
- Planned: a Studio Key client dashboard is not yet in scope.

---

## 13. Delivery and deployment

- Deliver amended files only. Do not produce full project zips unless Rich asks for one.
- No README or source files in deliverable zips unless Rich asks for them.
- Deploy via FileZilla drag-and-drop. Purge the Cloudflare cache manually after each deploy.
- Clean, flat styling. No hover effects or subtle interactions unless Rich specifically asks for them.
- Keep the build output in a deployable form that works with the drag-and-drop method.

---

## 14. Explicit exclusions

Do not include any of the following on the Studio Key site or in its copy:

- Overstone, property-sector or development content
- Azzurri Designs branding (merged and dissolved)
- Billing-recovery, arrears or back-bill figures
- Server IPs, hostnames, passwords, API keys or config values
- Personal details about Rich beyond his first name and the East Midlands location
- Rich's home address (being removed from the Google Business Profile)

---

## 15. Open questions for Rich

Confirm these before building. Do not assume.

1. The prior notes say a 40-page React/Vite site was already built and QA-passed. Is this a rebuild, a refresh, or a new build? Is there existing code in the repository?
2. Is the stack in section 4 final? The general preference is pure PHP, HTML, CSS and vanilla JS.
3. The qualifying section contains a spaced hyphen (" - ") and an awkward clause ("you suspect is a bit too expensive"). Keep verbatim or correct?
4. Which address and phone number should appear on the site, given the home address is being removed?
5. Which scheduling link should the CTAs use? (The current one belongs to Overstone.)
6. Confirm the candidate homepage title, or replace it with a title in the `Page Topic | Studio Key` format.
7. Should the Managed tier (£450/yr) appear on the public site, or only in sales conversations?
8. Keyword volume data is still pending. Build with placeholders or wait?
9. Should the white-label agency offer appear on the public site?

---

## 16. Working agreement

- Claude Code owns site structure and render logic.
- Push back on decisions that conflict with this document, and flag anything stale rather than letting it slide.
- When in doubt about copy, check section 8 before writing.
