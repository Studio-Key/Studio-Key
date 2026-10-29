# Product

<!-- impeccable:product-schema 1 -->

This file points at the existing docs instead of repeating them. Do not copy facts in here: update the source doc.

## Platform

web

## Order of authority

1. Impeccable findings and decisions (`/impeccable` commands). They override the PRD and every other doc where they conflict, including the locked homepage copy (PRD section 5) and the design system (PRD section 11). Confirmed by Rich, 28 Oct 2026.
2. `docs/PRD.md`.
   Taste Skill (`design-taste-frontend`) is a second design opinion. Where it disagrees with Impeccable, Impeccable wins.
3. `.claude/skills/studio-key-hosting/SKILL.md`, `docs/voice-and-customers.md`, `docs/page-plan.md`, `docs/seo-plan.md`, `docs/file-plan.md`.

Limits that still hold whatever Impeccable recommends: never invent or change facts, prices, reviews, certifications or claims; never publish anything on the "Banned" or "Do not publish" lists; keep tracking attribute names stable (`docs/file-plan.md` section 6). A copy change still follows the voice rules (British English, first person "I", no em dashes, no "actually").

## Users

PRD section 2. Skill file section 5 for pains, sectors and towns.

## Product Purpose

PRD section 1 (goal and metrics) and section 4 (pages and their jobs).

## Positioning

PRD section 3.

## Operating Context

PRD section 2 (Google and email-campaign arrival modes) and skill file section 4 (how Rich delivers).

## Capabilities and Constraints

- Offer, prices and terms: PRD sections 6 and 7.
- Functional requirements (video, form, contact routes, tracking): PRD section 10.
- Stack: plain PHP includes, one CSS file, vanilla JS, no build step, no CDNs. PRD section 13 and `CLAUDE.md`.
- Lighthouse 100 on every page; CSP allows only the hashed JS flag and the nonce'd `<style>`. `CLAUDE.md` hard rules.

## Brand Commitments

Voice: skill file section 7 and `docs/voice-and-customers.md`. Logo: `public/assets/img/logo.svg`. Font: Satoshi, self-hosted.

## Evidence on Hand

PRD section 8 (approved proof, three Google reviews). Missing and not to be faked: photo of Rich, About story, video, live review count, Google reviews link (PRD section 16).

## Accessibility & Inclusion

WCAG 2.2 AA. PRD section 11.9.
