# Studio Key website

Hosting business site for Rich (Studio Key, Corby, East Midlands). Plain PHP includes, one CSS file, vanilla JS. No build step, no frameworks, no CDNs.

## Before any task

- Load the `studio-key-hosting` skill (`.claude/skills/studio-key-hosting/SKILL.md`).
- Read `docs/PRD.md`. It wins over every other doc. If it is silent or conflicts with the code, ask Rich.
- Copy work: also follow `docs/voice-and-customers.md` and run stop-slop and humanizer checks.
- Page work: `docs/page-plan.md`. SEO work: `docs/seo-plan.md`. Structure and security: `docs/file-plan.md`.

## Run locally

`php -S localhost:8080 -t public deploy/dev-router.php`. Deploy steps: `docs/deploy.md`.

## Hard rules

- Homepage copy in PRD section 5 is locked. Do not reword it.
- British English, first person "I", no em dashes, no "actually" in new copy.
- Never publish anything in the skill's "Banned" list or `docs/voice-and-customers.md` "Do not publish".
- Keep tracking attribute names stable (`docs/file-plan.md`, section 6).
- Secrets live in `app/secrets.php` only. Never commit it.
- Keep Lighthouse at 100 on every page, mobile and desktop. No inline scripts or styles beyond the hashed JS flag and the nonce'd `<style>`.
- Do not over-engineer. If a feature is not in the PRD, ask first.
