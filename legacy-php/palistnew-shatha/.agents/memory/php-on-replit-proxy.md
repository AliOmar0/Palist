---
name: PHP serving behind the Replit proxy
description: Why PHP's built-in server needs nginx in front, and why asset URLs must be root-relative, when running a PHP app in Replit
---

# Serving a PHP app behind the Replit proxy

Two distinct problems bite when running a classic PHP app (e.g. a cPanel-style
CMS) in Replit. Both look like "page HTML loads but CSS/JS/images fail → unstyled
page", so don't conflate them.

## 1. `php -S` alone drops assets in the browser (but curl works)

The PHP built-in server (`php -S`) does not handle HTTP keep-alive the way the
Replit HTTP/2 proxy expects. Result: in the browser/preview every sub-resource
fails with `ERR_CONNECTION_CLOSED`, while `curl` (even 40x parallel, via the
proxy) always succeeds. Worker count (`PHP_CLI_SERVER_WORKERS`) and serving
statics via `readfile()` do NOT fix it.

**Fix:** put nginx in front. nginx listens on `0.0.0.0:5000` (the public port),
serves static files directly, and reverse-proxies dynamic requests to `php -S` on
`127.0.0.1:8080`. Run both as separate workflows. nginx must run non-root with a
workspace-local prefix (pid/logs/temp under `.nginx/`), `daemon off;`, and a
`location ~ \.php$` that proxies to PHP so source is never served raw.

**Why:** nginx speaks correct keep-alive to the proxy; php -S does not.

## 2. Absolute asset URLs are unreachable from the preview/screenshot browser

The app-preview/screenshot browser loads the page from `http://localhost:5000/`,
NOT from the public `*.replit.dev` domain. If the app emits **absolute** asset
URLs (`https://<dev-domain>/res/...`), that browser can't reach them →
`ERR_CONNECTION_REFUSED` on every sub-resource even though `curl` to those exact
absolute URLs returns 200. (The real preview iframe happens to work, but you
can't verify it via screenshot, and it's fragile.)

**Fix:** make the app emit **root-relative** URLs (`/res/...`, `/uploads/...`).
For the legion/ProVision CMS the whole URL tree derives from
`urlBase = http_protocol.main_url` in `panel/core/config.php`; set `urlBase` to
`""` under the Replit branch so `url` becomes `/` and every asset/link resolves
against whatever origin served the page. Works in localhost preview, public
preview, and deployment alike.

**Why:** root-relative URLs are origin-agnostic; absolute URLs hardcode an origin
the internal browser can't reach.

## 3. Don't serve the whole repo as static web root

Serving from the workspace root (nginx `root` and/or a `php -S` router that
`readfile()`s any existing file) exposes non-public artifacts: the DB dump in
`attached_assets/*.sql`, `scripts/*.sh`, dotdirs (`.git`, `.mysql`), and — worst
— PHP source like `panel/core/conn.php` with DB credentials (a `readfile()`
router will dump `.php` source instead of executing it). PHP `error_log` files
(no extension) at repo root and `panel/` also leak internal paths/traces.

**Fix (defense in depth):**
- The router must EXECUTE `.php` (via `require`), never `readfile()` it, and use a
  **whitelist (default-deny) of known static MIME types** — anything not on the
  list (incl. extensionless `error_log`) returns 404.
- nginx denies sensitive prefixes (`/attached_assets/`, `/scripts/`, `/backups/`,
  `/.agents/`), dotpaths (`~ /\.`), sensitive extensions, and exact operational
  filenames (`error_log`, `access_log`).

**Why:** the import drops sensitive files inside the served tree; allow-list what
is public rather than trying to blocklist everything sensitive.
