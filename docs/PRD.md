# Studio Key hosting website: PRD

Version 2.2, 28 Oct 2026. Replaces `docs/archive-original-prd.md`.

Companion docs:
- `.claude/skills/studio-key-hosting/SKILL.md`: business facts, claims, voice. Load before any task.
- `docs/voice-and-customers.md`: tone of voice and customer research.
- `docs/page-plan.md`: section-by-section page plans.
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

What they fear (loss aversion, section 12): downtime during a move, surprise renewals, poor support, losing control of their site, losing email.

Out of scope for this build: white-label agency offer.

## 3. Positioning

> Personal website hosting from Rich in Corby. One clear yearly price, free SSL for life, daily backups, and a person who answers the phone.

The test: swap in GoDaddy or 123-reg and it stops being true.

## 4. Scope

### Pages

| URL | Page | Job |
|---|---|---|
| `/` | Home | Long-form sales page. Video, locked copy, proof, form |
| `/pricing/` | Pricing | Both tiers, domains, support rate, what's included, terms, FAQs |
| `/about/` | About | Rich, his story, how he works, areas served, photo |
| `/contact/` | Contact | 3-step form, phone, WhatsApp, email, service area |

Utility pages (needed by law or the server, footer links only):
- `/privacy/`: privacy and cookies notice (form data, Brevo, GA4, first-party tracking).
- `/terms/`: hosting terms in plain English (billing, renewals, cancellation, refunds, migration scope, responsibilities). Short. Mirrors section 7.
- `404`: friendly not-found page with links to the four pages.

### Not in scope

- Blog, client dashboard, agency page, online payments, login areas, chatbot.
- The tracking dashboard itself. This build only tags the site so it can feed one later (section 10.4).

## 5. Homepage copy (locked)

Use exactly as written below. Changes from Rich's supplied copy are marked.

**H1:** Personal website hosting, without the hidden costs

**Intro:** I'm Rich, an independent website hosting provider based in the East Midlands. I look after over 110 business websites, providing reliable, affordable hosting with transparent pricing and personal support directly from me.

**H2:** Website hosting you can talk to someone about **["actually" removed, Rich confirmed 28 Oct]**

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

1. "£79+" stays as written (Rich confirmed 28 Oct). The £178 renewal-notice example can support it in an FAQ.
2. "Free SSL certificates for life" appears in two lists. Fine for scanning, but one could become "Free migration, I move your site for you".

### Copy Claude will draft (Rich approves before launch)

All new copy follows section 9. Sections needing new copy: how it works, pricing teaser, risk reversal block, FAQs, Pricing page, Contact page, form microcopy, footer, meta tags, 404, privacy, terms. About story is lorem ipsum until Rich supplies it.

## 6. Offer and pricing (public)

| Item | Price | How it shows on the site |
|---|---|---|
| Standard hosting | £119 a year, all-inclusive | "£119 a year. That's under £10 a month, with nothing added on." Renews at £119 |
| Managed hosting | £450 a year | "£450 a year (£37.50 a month)." Renews at £450 |
| .co.uk / .uk domain (if registered with me) | £14 a year | |
| .com domain (if registered with me) | £22 a year | |
| Support, fixes and changes | £65 an hour, quoted up front | |
| Moving your site to me | Free | Scope in section 7.1 |

Pricing display rules (anchoring):
- Show the real price large and once. No crossed-out prices, no "from" prices, no intro discounts.
- State billing frequency (yearly, in advance) and the renewal price beside every price.
- No VAT shown (not VAT registered). Say so once: "No VAT to add."
- SSL is included in the hosting price. Say so on the plan card.
- Billing hard rules from the original PRD stay internal and never appear on the site.

## 7. Terms, risk reversal and responsibilities

Specific assurances beat blanket guarantees. Every promise below is concrete and deliverable.

### 7.1 Free migration covers

- One website per hosting plan: WordPress, or a standard PHP/HTML site, with its files and database.
- Copying from the old host, testing on a private staging copy, switching DNS, checking everything works.
- Checking where email lives and keeping it running. Email stays where it is unless the customer asks to move it.
- Switching at a quiet time, with the customer on a call if they like.

Not covered (quoted separately at £65/hr, up front):
- Bespoke applications (custom Node.js, Python or similar).
- Fixing a broken or badly out-of-date site before it can move.
- Third-party licence costs (premium plugins, themes).
- Rebuilds or redesigns.

### 7.2 Downtime

Never promise zero downtime. Copy: "I test your site on my server before anything switches over, and I make the switch at a quiet time. Most moves go unnoticed by your visitors."

### 7.3 Cancellation and refunds

Modelled on the better UK and international hosts. Krystal gives a 60-day no-quibble refund minus domain costs; Kinsta gives 30 days, then refunds the unused time on annual plans.

Studio Key terms (confirmed by Rich, 28 Oct):
- **30-day money-back**: not happy in the first 30 days of a new hosting plan, you get the hosting fee back in full. Domain fees are non-refundable, and the domain stays yours.
- **After 30 days**: give one month's notice at any time. I refund the unused full months of your yearly fee.
- **Leaving is easy**: you get a full backup of your website free, and I help your new host get set up.
- **No auto-upsells**: renewal price is the price you paid, unless I write to you at least 30 days before any change.

### 7.4 Who looks after what

| Item | Standard | Managed |
|---|---|---|
| Server, security patching, firewall | Rich | Rich |
| SSL certificate and renewals | Rich | Rich |
| Daily backups to AWS S3, restores on request | Rich | Rich |
| WordPress core, plugin and theme updates | You (Rich can do them at £65/hr) | Rich |
| Uptime monitoring | Rich | Rich |
| Content changes | You (or £65/hr) | You (or £65/hr) |
| Domain renewal (if registered with Rich) | Rich | Rich |

This table also answers "what does Managed add?": updates to WordPress, plugins and themes.

## 8. Proof and trust

| Element | Wording | Status |
|---|---|---|
| Green hosting | Green Web Foundation badge, verified, linking to the live check (`thegreenwebfoundation.org/green-web-check/?url=www.studio-key.co.uk`). Badge shows "Hosted by Hetzner Online GmbH" | Approved |
| Google reviews | "5-star Google reviews" with three reviews (8.1). No count shown until Rich supplies the live total | Approved |
| AWS | "Backups stored on Amazon Web Services" with the "Powered by AWS" mark, following AWS trademark guidelines | Approved |
| Google certified | Removed | Rich could not evidence it |
| 110+ sites | In the intro copy | Approved |
| Photo of Rich | About header, small avatar near hero CTA and form | Placeholder until supplied |

### 8.1 Testimonials (Google reviews, all 5 stars)

Public Google reviews, shown with name and five stars. Em dashes in the originals become commas (punctuation only, no words changed). Long reviews are trimmed with an ellipsis.

**Ryan Young** ★★★★★
> Richard has been nothing but outstanding from the get go, he has developed my website beautifully over the past few years and has really listened intently to every detail of how my business operates and what's involved In order to produce the most efficient and effective website for my business. I continue to be super impressed with how Richard is still checking in monthly and offering ideas on improving the website and its image further which I feel I wouldn't get anywhere else. Highly recommend!

**Timothy Lyons** ★★★★★
> I recently worked with Rich from Studio Key on branding for my new business, and I couldn't be happier with the results. I absolutely love the branding he helped create, it's professional, eye-catching, and truly reflects the business. I've already received compliments from my customers! Rich also helped me set up web hosting and email, making sure everything fit within my budget, and suggested ways he could support me as my business grows. He was easy to work with, thoughtful, and genuinely invested in helping me succeed. Highly recommend!

**Tejal Prajapati** ★★★★★
> I've had the pleasure of working with Rich Devenport from Studio Key, and I can't recommend him highly enough. His quick and responsive approach has made collaborating on projects an absolute breeze. He's reliable, efficient, and always on hand to offer support when needed, which is so important in the fast-paced world of digital services…

Display: on Home, show a short pull line from each (bolded hosting-relevant sentence) with "Read more" to expand the full text. No wall of reviews. "See all reviews on Google" link once Rich supplies the public URL.

## 9. Copy standards

- British English. First person "I", never "we".
- No em dashes. No "actually" (bar the flagged locked H2). No adverbs unless removing one changes the meaning.
- No rule-of-three padding. No binary contrasts. Active voice. No vague declaratives.
- Plain English (cognitive fluency). No jargon above the fold: no NVMe, LiteSpeed, PHP workers, Nginx.
- Descriptive section headings that make sense when scanned on their own.
- Order on every page (progressive disclosure): outcome, then benefits, then proof, then detail. Technical detail lives in FAQs and expandable sections. Pricing and limits stay visible, never hidden.
- Never "discovery call". Use "15-minute call" or "quick chat".
- No "best hosting", no uptime percentages, no fake urgency or scarcity.
- Every page speaks to both visitor types: people moving an existing site and people getting hosting for the first time.
- Every draft passes the stop-slop and humanizer checks before Rich sees it.

### 9.1 CTAs (Hick's Law: one primary action)

Research, Oct 2026: there is no reliable published test comparing "See options" with other labels for service businesses. Most "X% lift" figures come from vendor blogs with no method. What the better guidance agrees on: say what happens next, keep the commitment small, and match the visitor's intent. "Move my website" failed the intent test because it shuts out first-time buyers.

| Role | Wording | Destination |
|---|---|---|
| Primary (one style, used everywhere) | **See your options** | `/contact/` step 1, which shows the options as one-tap cards |
| Secondary (quiet text link) | See my prices | `/pricing/` |
| Contextual (inside sections, same quiet style) | Get a free hosting check / Moving from another host? | Form with the matching step 1 card preselected (`?need=check`, `?need=move`) |
| Contact links | Call me / WhatsApp me / Send me a message | `tel:`, `wa.me`, form |

Why "See your options": it promises the next screen and nothing more, it fits movers and first-timers, and the click delivers what it says (step 1 lists the options).

Test plan: the primary label lives in `app/config.php`. Run "See your options" for 6 weeks, then "Talk to Rich" for 6 weeks, and compare form starts and completions per 100 visitors in GA4 and the event layer. Keep the winner.

"Let's talk" stays inside the locked copy as text. The visitor always chooses how to get in touch: form, email, WhatsApp or call. No forced sales call.

### 9.2 Free hosting check (approved lead magnet, reciprocity)

"Send me your web address and I'll tell you what you're paying for, what you're not getting, and whether moving makes sense. Free, no obligation, and I'll tell you if you're better staying put."

Delivered by Rich in a short email or call. Captured through the same form.

## 10. Functional requirements

### 10.1 Hero video

- Right of the text on desktop, below the H1 and intro on mobile. 5:4 frame (`aspect-ratio: 5 / 4`).
- Self-hosted MP4 (H.264, under 15 MB target) plus a WebP poster with Rich's face and a play button.
- `preload="none"`, no autoplay, click to play with sound. Native controls.
- WebVTT captions file. VideoObject schema once the real video exists.
- Placeholder until Rich uploads: poster image with "Video coming soon" and no `<video>` source.
- Video never pushes the primary CTA below the fold on mobile.

### 10.2 Enquiry form (3 steps, progressive disclosure)

On `/contact/` and at the bottom of `/`. One shared partial.

| Step | Fields | Logic |
|---|---|---|
| 1. What would help? | Radio cards: Move my existing website / Hosting for a new website / A free check of my current hosting / Not sure yet | Required. One tap. Preselected from `?need=` (`move`, `new`, `check`) |
| 2. Your website | Move or check: website address, current host, "What's bugging you?" tick-boxes from the pain list. New: domain name if you have one, "Do you need the website built too?" yes/no | All optional to keep momentum |
| 3. Your details | Name, email, phone (optional), how should I reply: Call / WhatsApp / Email, message (optional) | Name and email required. Phone becomes required if Call or WhatsApp is chosen |

- Progress indicator "Step 1 of 3". Back button keeps answers. Step changes animate gently (section 11.6).
- Works without JavaScript: all steps render as one form, server validates.
- Hidden fields: UTM source, medium, campaign, term, content (held in sessionStorage across pages), landing page, referrer, page submitted from.
- Spam: honeypot field, minimum fill time (3 seconds), stateless HMAC form token, rate limit per IP hash (5 per hour).
- On submit: Brevo API creates or updates the contact in a "Website enquiries" list, sends Rich a notification, sends the customer a confirmation in Rich's voice. **Brevo credentials parked**: build against `app/secrets.example.php`; until keys exist, every enquiry goes to the private lead log and an email to help@ via PHP `mail()`.
- Never lose a lead: if Brevo fails, write to the private log outside the web root.
- Success state: "Thanks [name]. I'll reply today or the next working day." Plus WhatsApp and phone links.
- Test on a real phone (iOS Safari and Android Chrome), not only desktop responsive mode.

### 10.3 Contact routes on every page

- Header: phone number (click to call) and the primary button.
- Mobile: sticky bottom bar with Call, WhatsApp, See your options. Hidden once the form is on screen.
- Footer: phone, WhatsApp, email, service area, legal line.

### 10.4 Analytics and tracking

- GA4 with Consent Mode v2. **Measurement ID parked**: config value left empty, GA4 does not load until it is set.
- Simple consent banner: Accept / Reject, same prominence. Choice stored first-party.
- First-party event layer (`track.js`) pushes to `window.dataLayer` and, when a collector URL is set in config, sends events by `navigator.sendBeacon`. Collector off at launch.
- Tagging rules for the future dashboard: `docs/file-plan.md`, section 6.
- Events: page view, section view, scroll depth (25/50/75/90), dwell time, CTA click, video play/progress/complete, form step view/complete, form submit, form error, phone, WhatsApp and email clicks, FAQ open, review expand.

### 10.5 Legal footer line

"Studio Key is a trading name of RMD Trading Limited. Registered in England and Wales, company no. 11656826. Registered office: 44 Furlong Close, Weldon, NN17 5AW."

Elsewhere the site says "Based in Corby, serving the East Midlands". Schema uses Corby as locality, no street address.

## 11. Design system

### 11.1 Visual style

- Clean, editorial layout. Avoid the high-energy hosting-provider look.
- Colours: dark navy or charcoal for text and dark sections, white and a warm off-white for backgrounds, one restrained green or blue accent for the primary button and links. Exact hex values captured from studio-key.co.uk once reachable; tokens in `:root`.
- A real photo of Rich in a fitting setting. No stock imagery, no call-centre photos, no server illustrations, no dashboard mock-ups.
- Simple static Phosphor icons (one weight, inline SVG).
- Subtle corner rounding (4px to 8px). No gradients, no glows, no drop shadows beyond a faint lift on hover.

### 11.2 Grid and spacing

- 4px base unit. Every margin, padding, gap and size is a multiple of 4: tokens `--space-1` (4px) to `--space-24` (96px).
- Layout grid: 4 columns on mobile, 8 on tablet, 12 on desktop, built with CSS Grid. Gutters 16px mobile, 24px tablet, 32px desktop.
- Max content width 1200px. Text columns capped at 65ch.

### 11.3 Breakpoints (mobile first)

| Token | Min width | Covers |
|---|---|---|
| base | 0 | Small phones (360px tested) |
| `sm` | 480px | Large phones |
| `md` | 768px | Tablets portrait |
| `lg` | 1024px | Tablets landscape, small laptops |
| `xl` | 1280px | Desktops |
| `2xl` | 1536px | Large screens (content stays at max width) |

No horizontal scroll at any width. Tested at 360, 390, 768, 1024, 1280, 1440.

### 11.4 Typography

- One typeface: Satoshi variable, self-hosted woff2. Weights 400, 500, 700 only.
- Fluid sizes with `clamp()`, for example:
  - Body: `clamp(1rem, 0.95rem + 0.25vw, 1.125rem)` (16px to 18px)
  - H1: `clamp(2.25rem, 1.6rem + 3vw, 3.75rem)`
  - H2: `clamp(1.75rem, 1.4rem + 1.6vw, 2.5rem)`
  - H3: `clamp(1.25rem, 1.15rem + 0.5vw, 1.5rem)`
  - Small: 0.875rem minimum, never for prices or terms.
- Line height 1.5 body, 1.15 headings. Paragraph width 45 to 75 characters.
- Prices and terms in full-contrast text, never small grey type.

### 11.5 Visual hierarchy

- The H1 is the strongest element on the page.
- Supporting copy is visibly secondary in size and weight.
- One primary button style. Secondary actions are text links or outline buttons.
- Bold, size and colour used sparingly. Not every element shouts.

### 11.6 Interaction and motion

Rich wants gentle, rewarding interactions. Keep them small and fast.
- Buttons: colour shift and 1px to 2px lift on hover, press-down on click, 150ms to 200ms ease-out.
- Links: underline offset change on hover.
- Form: radio cards highlight and tick when chosen; steps slide and fade in (200ms); a small tick animation on success.
- Sections may fade up once on first view (respecting reduced motion).
- FAQ and review expand with a short height transition.
- `prefers-reduced-motion: reduce` turns all motion off.
- No parallax, no autoplaying anything, no animated server graphics, no chatbot.
- Visible keyboard focus ring on every interactive element.

### 11.7 Fitts's Law and touch targets

- Buttons at least 48px tall on mobile, 44px minimum for any tap target.
- Whole cards and rows clickable where they lead somewhere, not just a tiny link.
- At least 8px between adjacent actions.
- Primary CTA reachable by thumb on mobile (sticky bar).

### 11.8 Whitespace and restraint

- Whitespace separates ideas. Prefer it to borders and boxes.
- Lists of benefits stay as lists. No floating card per benefit.
- Cards only where content is a true unit (price plans, reviews).
- Restrained palette, consistent spacing.

### 11.9 Accessibility

WCAG 2.2 AA. Contrast 4.5:1 body, 3:1 large text and UI. Labelled fields, error text tied to fields, skip link, semantic landmarks. Emoji in locked bullets wrapped `aria-hidden="true"`.

## 12. Persuasion and CRO principles

| Principle | How the site applies it |
|---|---|
| Specificity | Real yearly price with monthly equivalent, named support person, exact list of what's included |
| Risk reduction | Migration scope, backups, SSL, who looks after what, cancellation terms, what happens if something breaks |
| Anchoring | The real ongoing price shown prominently. No crossed-out or "from" prices |
| Commitment and consistency | Free hosting check and a migration chat as low-friction first steps |
| Endowment effect | "How it works" helps visitors picture their own site moved and looked after, email untouched |
| Processing fluency | Plain English, familiar layout, same terms everywhere ("website", "hosting", "move") |
| Authority | 110+ sites, Green Web Foundation verification, AWS backups, Rich's experience |
| Reciprocity | The free hosting check gives useful advice before any ask |
| Cognitive fluency | What it is, who it's for, why it's better, in the first screen |
| Hick's Law | One primary CTA, three nav links, two plans |
| Social proof | Three specific Google reviews, not a wall |
| Loss aversion | Address downtime, renewals, support and control head-on, without scare tactics |
| Human connection | Rich's name, photo, voice and phone number on every page |
| Progressive disclosure | Outcome, benefits, proof, detail. Specs in FAQs |

### 12.1 Mistakes to avoid

- Technical detail above the fold.
- "Best hosting", "99.99% uptime" or any claim without evidence.
- Fake urgency or scarcity.
- A wall of testimonials.
- Hidden or vague pricing.
- More than three nav links.
- Competing button colours.
- Excessive animation.
- Interrupting chatbots or pop-ups.
- Forcing a sales call.
- Vague security and backup claims.
- Designing for desktop first.

## 13. Non-functional

- No build step. Plain PHP 8.x includes, one CSS file, small vanilla JS files. Upload and go.
- Performance: LCP under 2.0s on 4G, total JS under 20 KB, no third-party scripts before consent (Green Web badge image excepted).
- Security: `docs/file-plan.md`, section 5.
- Hosting: Studio Key's own server (Hetzner, Nginx, PHP-FPM, Cloudflare in front). Web root points at `/public`.
- Deploy: GitHub holds the source. Upload `public/` and `app/` by FileZilla or git pull. Purge Cloudflare after each deploy.

## 14. Launch plan

1. Build in a dev location (e.g. `dev.studio-key.co.uk`), `noindex` and password-protected.
2. Rich reviews copy, prices, claims and open items.
3. Map every old URL to a new one (`deploy/redirects.conf`).
4. Go live on studio-key.co.uk, remove `noindex`, submit the sitemap in Search Console.
5. Check redirects, forms, lead delivery, GA4 and Core Web Vitals in the first week. Real-phone form test.

## 15. Marketing system (1-Page Marketing Plan)

| Square | Studio Key |
|---|---|
| 1. Target market | Small East Midlands business owners, non-technical, on a big host or a drifting agency |
| 2. Message | Personal hosting from Rich, one yearly price, nothing hidden, a person who answers |
| 3. Media | Google organic (town pages later), Google Business Profile once reinstated, Rich's email campaign with UTMs |
| 4. Capture | 3-step form, free hosting check, phone, WhatsApp |
| 5. Nurture | Brevo list "Website enquiries". Short follow-up sequence in Rich's voice (later phase) |
| 6. Convert | Quick chat, free migration or new set-up, 30-day money-back, clear yearly price |
| 7. Experience | Switch-over on a call, same-day replies, proactive security patching |
| 8. Lifetime value | Standard to Managed, £65/hr fixes, domains, website builds and maintenance |
| 9. Referrals | Ask after a quick fix or a smooth move. Google review request link (later phase) |

## 16. Open items for Rich

Blocking design:
1. studio-key.co.uk returns 403 to this build environment. The block comes from the site's own server firewall (cPanel, LiteSpeed, QUIC.cloud), not the session's network settings. Either whitelist the environment for an hour, or send hex codes, the logo SVG and a full-page screenshot.

Blocking launch:
2. Old site URL list or sitemap for redirects (same block as item 1).
3. About story and photo (lorem ipsum until then).
4. Is free migration the same on both tiers, one site per plan?

Parked (build works without them):
5. Google reviews public link and live review count.
6. Brevo API key, list ID, verified sender.
7. GA4 measurement ID.
