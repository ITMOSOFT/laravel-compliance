# ITMOSOFT Laravel Compliance

Compliance requirement and evidence tracking for Laravel applications, with polymorphic subjects, document metadata, review decisions, and expiry monitoring.

## Features

- Polymorphic subject ownership
- Requirement code, name, description and category
- Evidence/document metadata and storage reference
- Not-required, pending, submitted, approved, rejected and expired states
- Reviewer assignment, decision notes and review timestamp
- Effective and expiry dates with expiry checks

## Requirements

- PHP 8.3+
- Laravel 12 or 13

## Installation

```bash
composer require itmosoft/laravel-compliance
php artisan vendor:publish --tag=compliance-config
php artisan migrate
```

## Usage

Use the package's Eloquent model under `ITMOSOFT\\Compliance\\Models\\ComplianceRecord`. Create records with the required polymorphic relation fields and use the model lifecycle methods documented below.

### Lifecycle methods

- `submit()` submits pending or rejected evidence for review.
- `approve($reviewer, $notes)` approves a submitted compliance record.
- `reject($reviewer, $notes)` rejects a submitted compliance record.
- `isExpired()` checks the expiry date.

## Important boundaries

This package provides persistence models and lifecycle primitives. It does not provide authentication, authorization, approval routing, notifications, file uploads, electronic signatures, payment processing, or tenant isolation. Enforce permissions and business-specific validation in the host application. File paths and document metadata are references only; implement secure upload, storage, access control, and malware scanning in the application.

## Testing

```bash
composer install
composer test
```

## License

MIT.
