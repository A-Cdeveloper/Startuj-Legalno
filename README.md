# Startuj Legalno — WordPress Theme

Custom WordPress theme for **[Startuj Legalno](https://startuj-legalno.rs/)** — a marketing and content site built with **Bootstrap 5**, **Sass**, and **Advanced Custom Fields (ACF)**. The front end is component-driven (`global-templates/`, `loop-templates/`) with a Serbian (`sr_RS`) translation domain.

**Theme identity**

| | |
|---|---|
| **Text domain** | `startuj-legalno` |
| **Package (PHPDoc)** | `startuj-legalno` |
| **Version** | `1.0` (see `style.css` / `_S_VERSION` in `functions.php`) |
| **License** | GPL-2.0-or-later (WordPress theme) |

---

## Features

- **Responsive layout** — Bootstrap 5 grid, utilities, and bundled `bootstrap.bundle.min.js`
- **ACF-driven content** — options fields for homepage and shared site settings
- **Custom page templates** — Front Page plus default `page.php` for legal pages
- **Blog** — category archive with pill navigation; parent category query includes child posts; hero fields inherited from parent category when empty on child terms
- **Navigation** — [WP Bootstrap Navwalker](https://github.com/wp-bootstrap/wp-bootstrap-navwalker) (v4.x) with a small theme filter for Bootstrap 5 `data-bs-toggle` on dropdowns
- **Accessibility** — skip link, ARIA labels on key regions, semantic landmarks
- **Security** — optional lightweight HTTP headers (`X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy`, HSTS on HTTPS)

---

## Requirements

| Requirement | Notes |
|-------------|--------|
| **WordPress** | 6.x recommended (classic theme; block editor not required for most templates) |
| **PHP** | 8.0+ recommended (align with your hosting) |
| **Advanced Custom Fields (ACF PRO)** | Used extensively (`get_field`, options pages, repeaters) |
| **Node.js** | Only for **local asset builds** (Sass / PostCSS) — not required on the server |

Optional integrations referenced in code (filters, plugins): e.g. Email Address Encoder — only if present.

---

## Installation

1. Copy the theme folder into your WordPress installation:

   `wp-content/themes/startuj-legalno/`

2. In **Appearance → Themes**, activate **Startuj Legalno**.

3. Install and activate **ACF**.

4. Recreate **ACF field groups** to match the theme. Keep `general-settings` for shared site options.

5. Assign **menus** to:

   - `main_menu` — primary navigation  
   - `meta_menu` — header meta + footer links  
   - `responsive_menu` — mobile (if used in your markup)

6. Set **Settings → Reading** so the desired page uses the **Front Page** template.

---

## Development

### Install dependencies

```bash
cd wp-content/themes/startuj-legalno
npm install
```

### Scripts (`package.json`)

| Script | Purpose |
|--------|---------|
| `npm run watch:sass` | Watch `scss/` and compile Sass to the theme directory |
| `npm run build:bootstrap` | Build compressed Bootstrap bundle from `scss/bootstrap.scss` → `bootstrap.min.css` |
| `npm run prefix:css` | Autoprefix `bootstrap.css` → `bootstrap.min.css` (pipeline step) |
| `npm run build:css` | Compressed build of `scss/style.scss` → `style.min.css` |

The theme enqueues **`style.css`** and **`bootstrap.min.css`** from the theme root. After changing Sass, ensure the output file your environment relies on (`style.css` vs `style.min.css`) is updated consistently with your deployment process.

### Key paths

| Path | Role |
|------|------|
| `functions.php` | Setup, enqueue, ACF options registration, helpers, security headers |
| `scss/` | Source styles (entry: `style.scss`, Bootstrap entry: `bootstrap.scss`) |
| `global-templates/` | Reusable partials (logo, navigation, blog helpers) |
| `loop-templates/` | Content templates for home, pages, blog, 404 |
| `js/base.js` | Front-end behavior |
| `images/` | Theme assets and icons |

---

## Customization

- **Blog parent category** — default slug is `compliance-resursi`. Override via the filters `startuj_legalno_blog_category_slug` or legacy `digitalno_legalno_blog_category_slug`.

---

## Author

**E-SEO TEAM** — [e-seo.team](https://e-seo.team/)

---

## License

This theme is released under the **GNU General Public License v2 or later**, consistent with WordPress theme guidelines. See `License URI` in `style.css`.

Third-party code (e.g. **WP Bootstrap Navwalker**) retains its original license; see file headers in `class-wp-bootstrap-navwalker.php`.
