# Palist — Palestinian IT Syndicate

Bilingual (Arabic-first RTL + English) site, member portal, jobs board, and admin CMS for the Palestinian IT Syndicate (نقابة العلوم المعلوماتية التكنولوجية الفلسطينية). pnpm workspace monorepo using TypeScript.

Author: Ali Omar <alidawood098@gmail.com>.

## Brand
- Primary teal `#004953`, olive `#808000`, soft yellow CTA `#F5DF4D`.
- Font: Changa (Google Fonts). Border radius 5px. No emojis anywhere.
- Light + dark mode (toggle in navbar, persisted in `localStorage`).

## Auth & Roles
- Clerk handles auth (`/sign-in`, `/sign-up`). `requireAuth` syncs the Clerk user into `users` on first hit.
- Admin role is granted automatically to any signed-in user whose email is in `ADMIN_EMAILS` (comma-separated). Set `ADMIN_EMAILS=alidawood098@gmail.com` on Replit, then sign in to be promoted.
- All admin write actions are recorded in the `admin_audit_log` table (see admin → Audit log tab).

## Stack
- **Monorepo tool**: pnpm workspaces
- **Node.js**: 24
- **TypeScript**: 5.9
- **API**: Express 5, Drizzle ORM, PostgreSQL
- **Web**: React 19 + Vite 7 + TanStack Query + Wouter + Tailwind v4
- **PDF / QR**: `jspdf`, `qrcode` (membership card generation)
- **Build**: esbuild (CJS bundle for api-server)

## Key Commands
- `pnpm run typecheck` — full typecheck
- `pnpm run build` — typecheck + build
- `pnpm --filter @workspace/api-spec run codegen` — regen API hooks/Zod from OpenAPI
- `pnpm --filter @workspace/db run push` — push DB schema (dev)
- `pnpm --filter @workspace/scripts run seed` — seed bilingual sample data

## Routes (front-end)
Public: `/`, `/about`, `/membership`, `/news`, `/news/:id`, `/events`, `/events/:id`, `/training`, `/reports`, `/contact`, `/jobs`, `/jobs/:id`, `/verify/:cardId`, `/privacy`, `/terms`, `/sign-in`, `/sign-up`.
Member (auth): `/dashboard`, `/membership/apply` (3-step wizard), `/profile`.
Admin: `/admin` — News, Events, Trainings, Publications, Jobs, Applications, Contact, Newsletter, Audit log.

## Required env vars
- `DATABASE_URL`, `CLERK_SECRET_KEY`, `CLERK_PUBLISHABLE_KEY`, `VITE_CLERK_PUBLISHABLE_KEY`
- `ADMIN_EMAILS` — comma-separated emails granted the `admin` role
- `SESSION_SECRET` (already set)

See [`DOCUMENTATION.md`](./DOCUMENTATION.md) for the full feature catalog and `pnpm-workspace` skill for monorepo conventions.
