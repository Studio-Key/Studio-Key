# Studio Key hosting website: PRD

Version 2.0, 28 Oct 2026. Replaces `docs/archive-original-prd.md`.

Companion docs:
- `.claude/skills/studio-key-hosting/SKILL.md`: business facts, claims, voice. Load before any task.
- `docs/voice-and-customers.md`: tone of voice and customer research.
- `docs/page-plan.md`: section-by-section page plans and CRO.
- `docs/seo-plan.md`: keywords, meta, schema, redirects.
- `docs/file-plan.md`: architecture, includes, security, tracking tags.

Where these docs are silent or conflict with the code, stop and ask Rich.

---

## 1. Goal

Win local and regional small business hosting clients who are unhappy with big hosts and registrars.

| Metric | Target (first 90 days after launch) |
|---|---|
| Enquiries from the form, phone and WhatsApp | Track weekly; baseline in month 1 |
| Form completion rate (step 1 started to submitted) | 40%+ |
| Organic CTR on "website hosting [town]" terms (GSC) | Beat current site |
| Email campaign visit to enquiry rate | Tracked by UTM |
| Core Web Vitals | All green on mobile |

## 2. Audience

Primary: owners of small East Midlands businesses, not technical, arriving from Google or Rich's email campaign. Full pain list in the skill file, section 5.

Two arrival modes:
- **Google**: problem-aware, comparing providers. Needs price, proof and locality fast.
- **Email campaign**: knows Rich's name, needs the video, the price and an easy way to reply.

Out of scope for this build: white-label agency offer.

## 3. Positioning

> Personal website hosting from Rich in Corby. One clear yearly price, free SSL for life, daily backups, and a person who answers the phone.

The test: swap in GoDaddy or 123-reg and it stops being true.

## 4. Scope

### Pages

| URL | Page | Job |
|---|---|---|
| `/` | Home | Long-form sales page. Video, locked copy, proof, form |
| `/pricing/` | Pricing | Both tiers, domains, support rate, what's included, FAQs |
| `/about/` | About | Rich, his story, how he works, areas served, photo |
| `/contact/` | Contact | 3-step form, phone, WhatsApp, email, service area |

Utility pages (needed by law or the server, no nav slot):
- `/privacy/`: privacy and cookies notice (form data, Brevo, GA4, first-party tracking).
- `404`: friendly not-found page with links to the four pages.

### Not in scope

- Blog, client dashboard, agency page, online payments, login areas.
- The tracking dashboard itself. This build only tags the site so it can feed one later (section 9).

## 5. Homepage copy (locked)

Use exactly as written below. Changes from Rich's supplied copy are marked.

**H1:** Personal website hosting, without the hidden costs

**Intro:** I'm Rich, an independent website hosting provider based in the East Midlands. I look after over 110 business websites, providing reliable, affordable hosting with transparent pricing and personal support directly from me.

**H2:** Website hosting you can actually talk to someone about

If you're happy with a hosting provider that's difficult to contact, charges more than you expected, adds surprise yearly fees and treats you like just another account number, I'm probably not for you.

But if you want straightforward, honest website hosting with clear pricing and someone you can speak to directly, without waiting in a support queue, let's talk.

**H2:** Helping your business run reliably online

- No hidden costs
- Free SSL certificates for life
- Daily backups to Amazon AWS S3

**H2:** Sound familiar?

- 💸 Unexpected £79+ yearly SSL and domain protection fees
- 💸 Paying more than you should for hosting
- ❌ Confusing website management and unclear charges
- ❌ Feeling like you have no ownership of your website
- ⚠️ Unreliable or missing backups
- ⚠️ Slow, impersonal customer support

**H2:** A more straightforward approach

- ✅ Transparent, predictable pricing
- ✅ Free SSL certificates for life
- ✅ Complete ownership of your website
- ✅ Automatic, secure daily backups
- ✅ Direct support from me, without a call centre
- ✅ Practical advice tailored to your business
- ✅ Fast, reliable hosting on a private UK server **[changed from "private Nginx server": the estate is mixed, Rich confirmed 28 Oct]**

Keep your existing domain and website. There's no need to start again just to get better hosting.

### Copy flags (Rich to decide, build uses the locked text until then)

1. The H2 uses "actually", which the copy standards ban. Option: "Website hosting with a person you can talk to".
2. "£79+ yearly SSL and domain protection fees" is a claim about other providers. Keep only if Rich holds an example invoice or published price list. The mailbox shows a £178 third-party renewal notice, which is a stronger, evidenced example.
3. "Free SSL certificates for life" appears in two lists. Fine for scanning, but one could become "Free migration, I move your site for you".

### Copy Claude will draft (Rich approves before launch)

All new copy follows section 8. Sections needing new copy: how it works, pricing teaser, FAQs, About story, Pricing page, Contact page, form microcopy, footer, meta tags, 404, privacy notice.

## 6. Offer and pricing (public)

| Item | Price |
|---|---|
| Standard hosting | £119 a year, all-inclusive |
| Managed hosting | £450 a year |
| .co.uk / .uk domain (if registered with me) | £14 a year |
| .com domain (if registered with me) | £22 a year |
| Support, fixes and changes | £65 an hour, quoted up front |
| Moving your site to me | Free |

No VAT shown (not VAT registered). Billing hard rules from the original PRD stay internal and never appear on the site.

## 7. Proof and trust

| Element | Wording | Status |
|---|---|---|
| Google reviews | "5.0 on Google" + review count + link to reviews | Needs count and public link |
| AWS | "Backups stored on Amazon Web Services" with the AWS-approved "Powered by AWS" mark | OK, follow AWS trademark guidelines |
| Green hosting | "Hosted in data centres powered by renewable energy" with a leaf icon, no third-party badge | Needs Rich's evidence for every server in use |
| Google certified | Removed | Rich could not evidence it |
| 110+ sites | In the intro copy | OK |
| Testimonials | First name, business type, town | Needs written permission |
| Photo of Rich | Header of About, small avatar near hero CTA and form | Needs photo |

## 8. Copy standards

- British English. First person "I", never "we".
- No em dashes. No "actually" (bar the flagged locked H2). No adverbs unless removing one changes the meaning.
- No rule-of-three padding. No binary contrasts. Active voice. No vague declaratives.
- Never "discovery call". Use "15-minute call" or "quick chat".
- CTAs: "Let's talk" (primary), "Talk to me", "See my prices", "Send me a message", "WhatsApp me", "Call me".
- Every draft passes the stop-slop and humanizer checks before Rich sees it.

## 9. Functional requirements

### 9.1 Hero video

- Right of the text on desktop, below the H1 and intro on mobile. 5:4 frame (`aspect-ratio: 5 / 4`).
- Self-hosted MP4 (H.264, under 15 MB target) plus a WebP poster with Rich's face and a play button.
- `preload="none"`, no autoplay, click to play with sound. Native controls.
- WebVTT captions file (accessibility and SEO). VideoObject schema once the real video exists.
- Placeholder until Rich uploads: poster image with "Video coming soon" and no `<video>` source.

### 9.2 Enquiry form (3 steps, progressive disclosure)

On `/contact/` and at the bottom of `/`. One shared partial.

| Step | Fields | Logic |
|---|---|---|
| 1. What do you need? | Radio cards: Move my hosting to you / A new website / Not sure yet | Required. Picking "Move my hosting" reveals step 2's host field |
| 2. Your website | Website address (optional), current host (shown for "Move my hosting", optional), "What's bugging you?" tick-boxes from the pain list (optional) | All optional to keep momentum |
| 3. Your details | Name, email, phone (optional), preferred contact: Call / WhatsApp / Email, message (optional) | Name and email required. Phone becomes required if Call or WhatsApp is chosen |

- Progress indicator "Step 1 of 3". Back button keeps answers.
- Works without JavaScript: all steps render as one form, server validates.
- Hidden fields: UTM source, medium, campaign, term, content (from URL, held in sessionStorage across pages), landing page, referrer, page submitted from.
- Spam: honeypot field, minimum fill time (3 seconds), stateless HMAC form token, rate limit per IP hash (5 per hour).
- On submit: Brevo API creates or updates the contact in the "Website enquiries" list with all answers as attributes, sends Rich a transactional notification, sends the customer a confirmation in Rich's voice.
- If Brevo fails: write the enquiry to a private log outside the web root and show the success message with Rich's phone number. Never lose a lead.
- Success state: "Thanks [name]. I'll be in touch today or the next working day." Plus WhatsApp and phone links.

### 9.3 Contact routes on every page

- Header: phone number (click to call) and "Let's talk" button.
- Mobile: sticky bottom bar with Call, WhatsApp, Message.
- Footer: phone, WhatsApp, email, service area, legal line.

### 9.4 Analytics and tracking

- GA4 with Consent Mode v2. Nothing that sets non-essential cookies loads before consent.
- Simple consent banner: Accept / Reject, same prominence. Choice stored first-party.
- First-party event layer (`track.js`) pushes events to `window.dataLayer` and, when a collector URL is set in config, sends them by `navigator.sendBeacon`. Collector is off at launch.
- Tagging rules for the future dashboard are in `docs/file-plan.md`, section 6. Every section, CTA, form step and outbound contact link gets a stable `data-` tag.
- Events at launch: page view, section view, scroll depth (25/50/75/90), dwell time on exit, CTA click, video play/progress/complete, form step view, form step complete, form submit, form error, phone click, WhatsApp click, email click.

### 9.5 Legal footer line

"Studio Key is a trading name of RMD Trading Limited. Registered in England and Wales, company no. [NUMBER]. Registered office: 44 Furlong Close, Weldon, NN17 5AW."

Elsewhere the site says "Based in Corby, serving the East Midlands". Schema uses Corby as locality, no street address.

## 10. Design

- Reference: studio-key.co.uk for colour and style. Blocked from this build environment until Rich allows the domain. Tokens go in `:root` once captured.
- Feel: friendly, human, flat and clean. Lots of white space, Rich's face visible, warm accent colour.
- Font: Satoshi variable, self-hosted woff2, `font-display: swap`, preload the main weight.
- Icons: Phosphor, inlined SVG from a local partial. No CDN.
- Emoji in the locked bullets stay as emoji, wrapped `aria-hidden="true"` with the text read normally.
- Interaction: no hover animations or decorative motion (original PRD rule). Visible keyboard focus states are required for accessibility. Button hover colour change: open item.
- Accessibility: WCAG 2.2 AA. Contrast 4.5:1 body text, 44px touch targets, labelled form fields, skip link, `prefers-reduced-motion` respected.
- Responsive: 360px to 1440px. No horizontal scroll. 16px minimum body text.

## 11. Non-functional

- No build step. Plain PHP 8.x includes, one CSS file, small vanilla JS files. Upload and go.
- Performance: LCP under 2.0s on 4G, total JS under 20 KB, no third-party scripts before consent.
- Security: see `docs/file-plan.md`, section 5.
- Hosting: Studio Key's own server (Nginx, PHP-FPM, Cloudflare in front). Web root points at `/public`.
- Deploy: GitHub holds the source. Upload `public/` and `app/` by FileZilla (or git pull). Purge Cloudflare after each deploy.

## 12. Launch plan

1. Build in a dev location (e.g. `dev.studio-key.co.uk`), `noindex` and password-protected.
2. Rich reviews copy, prices, claims and the open items below.
3. Map every old URL to a new one (`deploy/redirects.conf`).
4. Go live on studio-key.co.uk, remove `noindex`, submit the sitemap in Search Console.
5. Check redirects, forms, Brevo, GA4 and Core Web Vitals in the first week.

## 13. Marketing system (1-Page Marketing Plan)

| Square | Studio Key |
|---|---|
| 1. Target market | Small East Midlands business owners, non-technical, on a big host or a drifting agency |
| 2. Message | Personal hosting from Rich, one yearly price, nothing hidden, a person who answers |
| 3. Media | Google organic (town pages later), Google Business Profile once reinstated, Rich's email campaign with UTMs |
| 4. Capture | 3-step form, phone, WhatsApp. Proposed lead magnet: "Free hosting check: send me your web address and I'll tell you what you're paying for and what you're not getting" |
| 5. Nurture | Brevo list "Website enquiries". Short follow-up sequence in Rich's voice (later phase) |
| 6. Convert | 15-minute call, free migration, no lock-in, clear yearly price |
| 7. Experience | In-person or on-call DNS switch, same-day replies, proactive security patching |
| 8. Lifetime value | Standard to Managed, £65/hr fixes, domains, website builds and maintenance |
| 9. Referrals | Ask at the moment of a quick fix or a smooth migration. Review request link to Google (later phase) |

## 14. Open items for Rich

Blocking design:
1. Allow `studio-key.co.uk` in the session's network settings so I can capture colours, logo and fonts. Or send hex codes and the logo SVG.

Blocking launch:
2. Company number for the footer.
3. Google reviews: rating, count and public link. Are they visible while the profile is disabled?
4. Renewable-energy evidence covering every server in use.
5. Managed tier: what exactly it adds over Standard (updates, monitoring, uptime checks, monthly report?).
6. Leaving: yearly billing plus "no lock-in". What's the notice period and is there any pro-rata refund?
7. Source for "£79+" or switch to the £178 example.
8. Keep "actually" in the H2?
9. Brevo: API key, list ID, verified sender address.
10. GA4 measurement ID.
11. Old site URL list or sitemap for redirects (I can pull it once the domain is allowed).
12. About story: years hosting, why you started, what you enjoy, a photo.
13. Testimonials: which clients to ask for permission.
14. Approve the "free hosting check" lead magnet wording.
15. OK for buttons to change colour on hover? Focus states stay regardless.
16. Is migration free on both tiers?
