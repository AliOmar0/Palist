# Palestinian IT Syndicate (Palist) Website

A high-end, bilingual (Arabic-first RTL with English) website for the Palestinian IT Syndicate — نقابة العلوم المعلوماتية التكنولوجية الفلسطينية.

## About

The site is the digital home of Palist, the national professional body representing IT and information science professionals across Palestine. It balances the credibility of an institutional portal with the polish of a modern SaaS product.

## Branding

- Primary: deep teal `#004953`
- Secondary: olive `#808000`
- Accent: soft yellow `#F5DF4D` (CTAs only)
- Background: white `#FFFFFF`
- Text: dark gray `#404040`
- Links: muted purple `#5B2D6D`
- Typography: Changa (Google Fonts) for both Arabic and English
- Border radius: ~5px

## Pages

- `/` — Home (hero, services, news, events, reports, quick access)
- `/about` — Mission, vision, leadership
- `/membership` — Tiers and registration
- `/news` — News & announcements
- `/events` — Events & workshops
- `/training` — Training programs
- `/reports` — Reports & publications
- `/contact` — Contact information and form

## Tech Stack

- React 19 + Vite
- TypeScript
- Tailwind CSS v4
- Wouter (routing)
- Framer Motion (animations)
- shadcn/ui components
- pnpm workspaces (monorepo)

## Development

```bash
pnpm install
pnpm --filter @workspace/syndicate-web run dev
```

## Build

```bash
pnpm run build
```

## Project Structure

```
artifacts/
  syndicate-web/      # Main Palist website (React + Vite)
  api-server/         # Shared Express API server
  mockup-sandbox/     # Design mockup sandbox
lib/
  api-spec/           # OpenAPI contract
  api-client-react/   # Generated React Query hooks
  api-zod/            # Generated Zod schemas
  db/                 # Drizzle schema and DB client
```

## Author

Ali Omar — alidawood098@gmail.com

## License

MIT
