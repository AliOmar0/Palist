# Palist — Palestinian IT Syndicate

Bilingual (Arabic-first RTL + English) site, member portal, and admin CMS for the Palestinian IT Syndicate (نقابة العلوم المعلوماتية التكنولوجية الفلسطينية). pnpm workspace monorepo using TypeScript.

Author: Ali Omar <alidawood098@gmail.com>.

## Brand
- Primary teal `#004953`, olive `#808000`, soft yellow CTA `#F5DF4D`.
- Font: Changa (Google Fonts). Border radius 5px. No emojis anywhere.

## Auth & Roles
- Clerk handles auth (`/sign-in`, `/sign-up`). `requireAuth` syncs the Clerk user into `users` on first hit.
- Admin role is granted automatically to any signed-in user whose email is in the `ADMIN_EMAILS` env var (comma-separated). Set `ADMIN_EMAILS=alidawood098@gmail.com` on the Replit project, then sign in to be promoted to admin.

## Stack

- **Monorepo tool**: pnpm workspaces
- **Node.js version**: 24
- **Package manager**: pnpm
- **TypeScript version**: 5.9
- **API framework**: Express 5
- **Database**: PostgreSQL + Drizzle ORM
- **Validation**: Zod (`zod/v4`), `drizzle-zod`
- **API codegen**: Orval (from OpenAPI spec)
- **Build**: esbuild (CJS bundle)

## Key Commands

- `pnpm run typecheck` — full typecheck across all packages
- `pnpm run build` — typecheck + build all packages
- `pnpm --filter @workspace/api-spec run codegen` — regenerate API hooks and Zod schemas from OpenAPI spec
- `pnpm --filter @workspace/db run push` — push DB schema changes (dev only)
- `pnpm --filter @workspace/scripts run seed` — seed initial bilingual news/events/training/publications
- `pnpm --filter @workspace/api-server run dev` — run API server locally

## Routes (front-end)
- `/` — public homepage (auto-redirects signed-in users to `/dashboard`)
- `/about`, `/membership`, `/news`, `/events`, `/training`, `/reports`, `/contact` — public pages
- `/sign-in`, `/sign-up` — Clerk auth pages (branded)
- `/dashboard` — member portal (status of application + quick links)
- `/membership/apply` — bilingual membership application form
- `/admin` — admin CMS (news / events / trainings / publications / applications / contact)

## Required env vars
- `DATABASE_URL`, `CLERK_SECRET_KEY`, `CLERK_PUBLISHABLE_KEY`, `VITE_CLERK_PUBLISHABLE_KEY` (auto-provisioned)
- `ADMIN_EMAILS` (comma-separated emails that should receive the `admin` role)
- `SESSION_SECRET` (already set)

See the `pnpm-workspace` skill for workspace structure, TypeScript setup, and package details.
