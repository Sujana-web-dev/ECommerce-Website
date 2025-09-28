<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
# ECommerce Website (Laravel)

This repository contains the ECommerce Website project built with Laravel. The following quick-start guide covers setup and common commands tailored for Windows (cmd.exe).

## Prerequisites
- PHP 8.x or compatible
- Composer (https://getcomposer.org)
- Node.js and npm (https://nodejs.org)
- SQLite (optional - repository includes `database/database.sqlite`)

If you prefer MySQL/Postgres, update the `.env` database settings accordingly.

## Quick setup (Windows - cmd.exe)
Open a Windows `cmd.exe` at the repository root (`c:\Users\SUJANA\OneDrive\Desktop\Ecommerce_Website`) and run:

1. Install PHP dependencies with Composer:

```
composer install
```

2. Copy environment file and generate application key:

```
copy .env.example .env
php artisan key:generate
```

3. (Optional) If you want to use SQLite and don't have the DB file, create it:

```
if not exist database\database.sqlite type nul > database\database.sqlite
```

4. Configure `.env` for your database. For SQLite, set:

```
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

5. Run migrations and seeders (creates schema and sample data):

```
php artisan migrate --seed
```

6. Install frontend dependencies and build assets:

```
npm install
npm run dev   (for development)
npm run build (for production build)
```

7. Serve the application locally:

```
php artisan serve
```

Open your browser at the URL shown (usually `http://127.0.0.1:8000`).

## Running tests
Use Laravel's test runner:

```
php artisan test
```

Or (alternative) run PHPUnit directly:

```
vendor\bin\phpunit
```

## Common troubleshooting
- If `composer install` fails, ensure your PHP CLI meets the required extensions (PDO, mbstring, BCMath, OpenSSL, tokenizer, xml).
- If migrations fail, verify database settings in `.env` and that the database file exists (for SQLite) or database credentials are correct (MySQL/Postgres).
- On Windows path issues, prefer using full paths or PowerShell where appropriate.

## Project artifacts added by this work
- `diagrams/Activity_ECommerce.drawio` — activity diagrams for key flows (Login, Manage Product, Search Product, Cart & Checkout, View Order, Report Generation).
- `generated/PROJECT_DELIVERABLES.md` — consolidated project deliverable (SRS summary, function point analysis, schedule, run instructions).

If you'd like, I can also:
- export diagrams to PNG/PDF into `diagrams/exports/` for submission,
- add `generated/DIAGRAMS_NOTES.md` describing each diagram and how to open/export it.

---

If you want me to proceed with exporting diagrams or creating the diagrams notes, tell me and I'll continue.
