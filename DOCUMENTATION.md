# Palist — Feature Documentation

Maintainer: Ali Omar <alidawood098@gmail.com>.

This document is the authoritative catalog of features in the Palist (Palestinian IT Syndicate) project. Brand & stack details live in [`replit.md`](./replit.md).

---

## 1. Bilingual UX (AR-first RTL + EN)

- `LanguageProvider` (`artifacts/syndicate-web/src/lib/language-context.tsx`) toggles `dir="rtl"|"ltr"` on the layout root.
- Default language is **Arabic**. All public pages, dashboards, admin panels, forms, errors, and emails are translated.
- Translations are inlined per component (`isAr ? '…' : '…'`) for fastest iteration; the `t()` function covers nav labels.
- Logical CSS properties (`ms-*`, `me-*`, `start-*`, `end-*`) are used everywhere so RTL flips for free.

## 2. Theme: Light + Dark mode

- `ThemeProvider` (`src/lib/theme-context.tsx`) toggles a `dark` class on `<html>` and persists in `localStorage` (`palist.theme`).
- Honors `prefers-color-scheme` on first load.
- Toggle button (sun/moon) lives in the navbar (desktop and mobile).
- Tailwind v4 `@custom-variant dark (&:is(.dark *))` already wired in `index.css`.

## 3. Accessibility

- Logo has descriptive alt text in both languages.
- Form inputs have visible labels (or `sr-only` + `aria-label` for newsletter).
- Visible focus rings (`focus-visible:ring-2 ring-primary`) on all interactive elements.
- Errors use `role="alert"`.
- Stepper uses `<ol aria-label>`.
- All actionable buttons have aria-labels when icon-only.

---

## 4. Public site

| Route | Purpose |
|---|---|
| `/` | Hero, mission, news preview, CTAs (auto-redirects signed-in users to `/dashboard`). |
| `/about` | History, vision, leadership. |
| `/membership` | Membership tiers + benefits + “Apply now” CTA. |
| `/news` | Searchable bilingual news grid (DB-backed). |
| `/news/:id` | Full article view with cover image, summary, body. |
| `/events` | Upcoming events list. |
| `/events/:id` | Event detail with date, location, description. |
| `/training` | Training programs catalogue. |
| `/reports` | Publications/reports library. |
| `/contact` | Contact form (writes to `contact_messages`). |
| `/jobs` | Live job board (filter by title/company). |
| `/jobs/:id` | Full posting + “Apply” form (members only). |
| `/verify/:cardId` | Public membership-card verification (used by the QR code). |
| `/privacy`, `/terms` | Static legal pages. |

### Search (Arabic-friendly)
News list supports `?q=` server-side via PostgreSQL `ILIKE` against title and summary in both Arabic and English.

---

## 5. Authentication & user lifecycle

- Clerk (`/sign-in`, `/sign-up`) — branded with Palist colors and Changa font.
- `requireAuth` middleware (`artifacts/api-server/src/middlewares/auth.ts`) verifies the Clerk JWT, upserts the row in `users`, and exposes `req.user`.
- `requireAdmin` extends it: any signed-in user with email in `ADMIN_EMAILS` is promoted to role `admin` automatically on next request.
- `auditAdmin(action, entityType)` middleware wraps every admin write to insert into `admin_audit_log`.

---

## 6. Member portal (`/dashboard`)

- Greeting + profile card (avatar, role).
- Membership status card (latest application + tier).
- **“Download membership card” PDF button** appears once the latest application is `approved`.
- “My resources” shortcut list (news, events, training).
- Past applications table.
- “Open admin dashboard” banner for admins.

### Membership card (PDF + QR + verify)

`src/lib/membership-card.ts` produces a credit-card-sized landscape PDF (85.6 × 54 mm) using **jsPDF**:

- Brand teal background with yellow accent stripe.
- Member name (English + Arabic), `Member #`, tier, expiry.
- 22 mm QR code (rendered with `qrcode`) pointing to `${origin}/verify/${cardId}`.
- File name `palist-membership-<number>.pdf`.

`cardId` (UUID) and `membershipNumber` (`PIT-YYYY-00000`) and `expiresAt` (+1 year) are generated automatically when an admin approves an application. The public route `/api/verify/:cardId` returns whether the card is currently valid (status `approved`, not expired).

---

## 7. Membership application (3-step wizard)

`/membership/apply` is split into three steps with a stepper, prev/next, and per-step validation:

1. **Personal information** + Address (validates email/confirm match, required fields).
2. **Education + Employment**.
3. **Membership tier + notes + legally-binding declaration checkbox**.

Submits to `POST /api/membership/apply`, then shows a success card with a “Back to dashboard” CTA.

---

## 8. Jobs board

DB tables: `jobs`, `job_applications`.

- Public list (`/jobs`) with title/company search.
- Detail page (`/jobs/:id`) with company logo, type, category, location, description.
- **Apply form is gated**: only signed-in users with at least one `approved` membership application can submit. Non-members see a CTA to apply for membership instead.
- Admins manage postings via the **Jobs** tab in `/admin`.

API endpoints:
- `GET /api/jobs`, `GET /api/jobs/:id`
- `POST /api/jobs/:id/apply` (auth + member check)
- `GET/POST/PATCH/DELETE /api/admin/jobs[/...]`

---

## 9. Newsletter

Table: `newsletter_subscribers`.

- Footer signup form (every page) → `POST /api/newsletter/subscribe` with `{ email, lang }` (idempotent via `ON CONFLICT DO NOTHING`).
- Admin **Newsletter** tab lists all subscribers, includes “Copy CSV” and “Compose digest” (opens `mailto:?bcc=…` with the full subscriber list pre-filled).

---

## 10. Admin CMS (`/admin`)

Tabs:

| Tab | Manages |
|---|---|
| Overview | Counts + quick stats. |
| News | CRUD bilingual articles with cover image upload. |
| Events | CRUD events with cover image, location, schedule. |
| Trainings | CRUD training programs. |
| Publications | CRUD reports/publications. |
| **Jobs** | CRUD job postings (title AR/EN, company + logo, employment type, category, apply URL, contact email, expiry, full bilingual description). |
| Applications | Review & approve/reject membership requests; approval auto-issues `membershipNumber`, `cardId`, `expiresAt`. |
| Contact | Inbound contact-form messages. |
| **Newsletter** | List subscribers; copy CSV; compose mailto digest. |
| **Audit log** | Read-only feed of every admin write (action, entity, actor, timestamp). |

All managers share the `GenericManager` component (table + add/edit modal + delete confirmation + image upload). Image uploads land in object storage via `/api/uploads`.

---

## 11. Profile, Privacy, Terms

- `/profile` lets members update first/last name, edit email, change avatar (Clerk `imageUrl`), and view raw account metadata.
- `/privacy`, `/terms` are static bilingual legal pages.

---

## 12. Database schema

Source: `lib/db/src/schema/*.ts`.

- `users` — synced from Clerk; `role` ∈ {member, admin}.
- `member_applications` — full bilingual membership form, `status`, `cardId` (uuid), `membershipNumber`, `expiresAt`.
- `news_articles`, `events`, `trainings`, `publications` — public content with `*Ar`/`*En` columns and optional `coverImage`.
- `contact_messages` — public inbound messages.
- `jobs`, `job_applications` — jobs board.
- `newsletter_subscribers` — email + lang, unique on email.
- `admin_audit_log` — `actorUserId`, `action`, `entityType`, `entityId`, `payload` (jsonb), `createdAt`.

Push schema: `pnpm --filter @workspace/db run push`.

---

## 13. API surface (Express)

Routes live in `artifacts/api-server/src/routes/*.ts` and are mounted under `/api` by the proxy.

Public:
- `GET /api/healthz`
- `GET /api/news`, `GET /api/news/:id`, `GET /api/events`, `GET /api/events/:id`
- `GET /api/trainings`, `GET /api/publications`
- `GET /api/jobs`, `GET /api/jobs/:id`
- `GET /api/verify/:cardId`
- `POST /api/contact`
- `POST /api/newsletter/subscribe`

Authenticated (member):
- `GET /api/me`
- `GET /api/membership/me`, `POST /api/membership/apply`
- `POST /api/jobs/:id/apply`
- `POST /api/uploads/sign` (object-storage upload URL)

Admin (also writes to audit log):
- `GET/POST/PATCH/DELETE /api/admin/{news,events,trainings,publications,jobs}[/...]`
- `GET/PATCH /api/admin/applications`
- `GET /api/admin/contact`
- `GET /api/admin/newsletter`
- `GET /api/admin/audit`

---

## 14. Local development

```bash
pnpm install
pnpm --filter @workspace/db run push
pnpm --filter @workspace/scripts run seed   # optional sample data
# workflows are managed by Replit — no need for `pnpm dev` at the root
```

Then visit the preview pane. Health check: `curl localhost:80/api/healthz`.

---

## 15. Deployment notes

- Set `ADMIN_EMAILS` in Replit Secrets, then sign in with one of those addresses to gain admin access.
- `DATABASE_URL`, `CLERK_*`, `SESSION_SECRET` are auto-provisioned.
- Build with `pnpm run build`; the api-server emits an esbuild bundle to `artifacts/api-server/dist/`. Static web is served by Vite/Replit.
- Object storage for uploads is wired through `/api/uploads/sign`.
