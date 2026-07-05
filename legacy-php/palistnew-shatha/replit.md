# Palist — Legion CMS (ProVision)

Bilingual (Arabic/English) website for a Palestinian syndicate ("Palist"), built
on the **legion** PHP CMS framework by ProVision.

## Stack

- **PHP 8.2** (built-in server `php -S`, mysqli)
- **MariaDB 10.11** (local, socket-based)
- **nginx 1.28** as the public web server / reverse proxy

## Architecture in Replit

The Replit preview proxy uses HTTP/2 with keep-alive, which PHP's built-in server
does not handle well (assets drop with `ERR_CONNECTION_CLOSED`). So nginx sits in
front:

```
browser → Replit proxy :443 → nginx :5000 → php -S :8080 (backend)
                                  └─ serves static assets directly
```

- **nginx** (`scripts/nginx.conf`, started by `scripts/start_nginx.sh`) listens on
  `0.0.0.0:5000`, serves static files from the workspace, and proxies `.php` and
  unmatched routes to the PHP backend. It denies access to sensitive paths
  (`/attached_assets/`, `/scripts/`, dotfiles, `*.sql`, `error_log`, etc.).
- **PHP backend** runs `php -S 127.0.0.1:8080 router.php`. `router.php` emulates the
  original `.htaccess` rewrites, executes `.php` files, and serves only
  whitelisted static MIME types (default-deny).
- **MariaDB** (`scripts/start_mariadb.sh`) stores data in `.mysql/` (gitignored)
  and exposes its socket at `/run/mysqld/mysqld.sock`. Database `palist_legion`
  (83 tables) is imported from `attached_assets/palist_legion_*.sql`.

## Replit-specific config

`panel/core/config.php` has an `is_replit` branch that:
- computes filesystem paths from the workspace root (no cPanel layout),
- derives the public host per-request from `HTTP_HOST`,
- emits **root-relative** asset/link URLs (`urlBase=""`) so assets resolve against
  whatever origin serves the page (preview, public domain, or deployment).

DB credentials live in `panel/core/conn.php` (root / empty password / `palist_legion`).

## Workflows

- **MariaDB** — `bash scripts/start_mariadb.sh`
- **PHP Backend** — `php -S 127.0.0.1:8080 router.php` (localhost backend)
- **Start application** — `bash scripts/start_nginx.sh` (public server on :5000)

## Deployment

Configured as a **VM** deployment running `scripts/start_production.sh`, which
boots MariaDB, imports the dump on first run if the DB is empty, then starts the
PHP backend and nginx.

## Known content gap

`uploads/` contains only sample/default files. User-uploaded media (images,
custom fonts referenced in the DB) is not version-controlled, so some images and
the custom brand fonts fall back to defaults. This is expected and not a bug.

## User preferences

(none recorded yet)
