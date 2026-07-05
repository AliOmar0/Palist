---
name: legion CMS scoped theming & content gaps
description: How to restyle individual pages of this shared multi-owner legion CMS without affecting other pages, plus the missing-uploads rendering behavior.
---

# Scoped page redesigns (the `.prx` overlay pattern)

This repo is a multi-owner site: different people own different page templates, so a
redesign must be provably isolated to the pages it targets.

**Convention:** add a single new stylesheet whose EVERY selector is anchored under an
opt-in wrapper class (we used `.prx`). A template opts in by `<link>`-ing the stylesheet
and wrapping its body in `<div class="prx prx-<page>">…</div>`. No shared file
(`header.php`, `footer.php`, `legion_header.php`, global CSS) is edited.

**Why:** the only safe guarantee against leaking styles into teammates' pages is that a
rule cannot match unless the `.prx` ancestor is present.

**How to apply:**
- Anchor *every* selector with a leading `.prx ` (or `.prx.`), including namespaced
  inner-element classes like `.prx-hero`, `.prx-bc` → write them `.prx .prx-hero`.
  Page-wrapper classes (`.prx-laws #foo`) are already safe because that class sits on
  the same element as `.prx`.
- Open the wrapper right after the `$_m='…';` module assignment; close it after
  `<?php include 'legion_share.php'?>` (or before `footer.php` on pages with no
  legion_share, e.g. internal_system).
- Hide legacy duplicate page titles via CSS rather than deleting them from templates.
- Templates contain a fragile "comment-wrapped PHP loop" hack (`<!--<?php … ?>-->`).
  Never wrap inside it — only at section level.

# Missing user-uploads content gap (NOT a bug)

`uploads/` is not version-controlled, so in dev/preview most media is absent:
- The `pic()` helper renders the literal text **`NA`** where an image would be.
- A missing PDF in an `<iframe src="/uploads/*.pdf">` 404s and the router serves the
  site as a fallback, so the iframe shows a tiny embedded copy of the site header.
- Custom brand fonts referenced in the DB (`/uploads/*.ttf`) fail to decode → fallback font.
All of these resolve once real uploads exist in production. Design image cells with a
branded fallback background + a `min-height` so cards never collapse when the image is "NA".

# Asset cache-busting is OFF

The site setting `clear_cache` is `0`, so `clearCache()` emits nothing and CSS `<link>`s
have no version query. nginx sends ETag/Last-Modified only (no Cache-Control), so edits
revalidate via ETag. If a preview seems to use stale CSS, it's browser heuristic caching,
not the server.

# Legacy gotcha: `black_s2`

`black_s2` (in main.css) is `position:absolute; width:100%; height:99%` with no positioned
ancestor — it escapes its card and can blanket the page / cause a horizontal scrollbar.
Neutralize it inside a redesigned card (`display:none` and/or give the card `position:relative`).
