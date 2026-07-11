# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a **SilverStripe CMS 6** installation based on the official installer, running PHP 8.3+ with `silverstripe/recipe-cms`. The web root is `public/`, not the project root.

## Local Development (Docker)

```sh
docker-compose up --build        # Start MySQL + Apache/PHP at http://localhost:8080
docker-compose exec web bash     # Shell into web container
```

DB credentials (pre-configured in docker-compose.yml): `silverstripe/silverstripe`, database `silverstripe`. Default CMS admin: `admin` / `password`.

For non-Docker setups, copy `.env.example` to `.env` and fill in DB credentials.

## SilverStripe CLI (sake)

```sh
vendor/bin/sake dev/build flush=1    # Rebuild database schema + flush manifest cache
vendor/bin/sake dev/build            # Rebuild schema only
```

Run `dev/build` after any model, config, or template changes. Flushing the cache (`flush=1`) is required after adding new PHP classes or changing config YAML.

## Running Tests

```sh
vendor/bin/phpunit                          # Run all tests
vendor/bin/phpunit app/tests/SomeTest.php   # Run a single test file
```

Tests require a configured database. No test-specific phpunit.xml exists yet; PHPUnit uses its defaults.

## Linting

```sh
vendor/bin/phpcs app/                  # Check coding standards
vendor/bin/phpcbf app/                 # Auto-fix coding standards
```

Standards are defined in `phpcs.xml.dist`: PSR-2 base with SilverStripe-specific exclusions (no namespace required, underscores in class names allowed).

## Architecture

### Directory Layout

- `app/src/` — project PHP classes (Page, PageController, and any custom DataObjects/Extensions)
- `app/_config/` — YAML configuration files loaded by SilverStripe's config system
- `themes/startup-theme/` — default theme with `.ss` templates, CSS, and JS
- `public/` — web root served by Apache; `public/_resources/` contains symlinked vendor theme assets
- `vendor/silverstripe/` — core framework, CMS, assets, admin, and other modules

### SilverStripe Conventions

**DataObjects & ORM:** Classes extend `DataObject` (or `SiteTree` for pages). Database fields are declared via `private static $db`, relationships via `$has_one`/`$has_many`/`$many_many`. Schema changes require a `dev/build`.

**Config system:** YAML files in `app/_config/` are merged by the config manifest. Order/priority is controlled by `Before`/`After` and `Only` directives. PHP `private static` properties are also config sources.

**Templates:** `.ss` files in `themes/startup-theme/templates/`. `Layout/Page.ss` is rendered inside `Page.ss`. Includes live in `Includes/`. Theme cascade is: `$public` → `startup-theme` → `$default` (see `app/_config/theme.yml`).

**URL routing:** Controllers are resolved via `Director` rules or automatically from `SiteTree`. `$allowed_actions` on a controller explicitly whitelist routable actions.

**Flush:** The manifest cache must be flushed (`?flush=1` in browser or `flush=1` with sake) when adding new PHP classes, changing YAML config, or adding new templates.
