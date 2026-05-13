# Shortzlino WordPress Theme

This is a classic WordPress theme scaffold with reusable template parts.

## Main Templates

WordPress requires template files like `front-page.php`, `index.php`, and `page.php` in the theme root. Those root files are thin wrappers.

Editable page markup lives in `pages/`:

- `pages/front-page.php` - homepage layout.
- `pages/index.php` - default posts listing.
- `pages/page.php` - static pages.
- `pages/single.php` - single blog posts.
- `pages/archive.php` - archives.
- `pages/category.php` - category archive.
- `pages/taxonomy-product_cat.php` - WooCommerce product category archive.
- `pages/search.php` - search results.
- `pages/404.php` - not found page.

## Inc

## Components

- `inc/security.php` - direct-access protection and basic hardening.
- `inc/page-loader.php` - loads files from `pages/`.
- `inc/redirects.php` - page redirect rules.

- `template-parts/components/page-hero.php` - page and archive hero.
- `template-parts/components/section-heading.php` - reusable section heading.
- `template-parts/components/featured-media.php` - featured image block.
- `template-parts/components/pagination.php` - post archive pagination.
- `template-parts/content/content-card.php` - post preview card.
- `template-parts/content/content-page.php` - page body.
- `template-parts/content/content-single.php` - post body.
- `template-parts/content/no-results.php` - empty state.

## Assets

- `assets/css/main.css` - main frontend styling.
- `assets/js/main.js` - mobile menu behavior.

Next good build steps are adding custom homepage sections, ACF fields or block patterns, and any brand-specific styling.
