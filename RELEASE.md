# Release instructions

- Repository: `ITMOSOFT/laravel-compliance`
- Composer package: `itmosoft/laravel-compliance`
- Initial tag: `v1.0.0`

## Validate locally

```bash
composer validate --strict
composer install
composer test
```

## User-run Git commands

Run these yourself after local tests pass and GitHub Actions succeeds:

```bash
git add .
git commit -m "chore: prepare compliance v1.0.0"
git push origin main
git tag -a v1.0.0 -m "Release v1.0.0"
git push origin v1.0.0
```

## GitHub Release

Title: `v1.0.0 — Initial Release`

Description:

```markdown
## Highlights

- Polymorphic subject ownership.
- Requirement code, name, description and category.
- Evidence/document metadata and storage reference.
- Not-required, pending, submitted, approved, rejected and expired states.
- Reviewer assignment, decision notes and review timestamp.
- Effective and expiry dates with expiry checks.

## Requirements

- PHP 8.3+
- Laravel 12 or 13

## Installation

composer require itmosoft/laravel-compliance
php artisan migrate

```

## Packagist

Submit the public repository at https://packagist.org/packages/submit and verify that Packagist detects `v1.0.0`.
