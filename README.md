# Kakeibo — Subscription Tracker

Kakeibo is a practical subscription and recurring payment tracker for students, freelancers, and developers who want to know how much they pay every month for tools, hosting, domains, streaming, cloud services, and apps.

## Problem Solved

Recurring payments are easy to forget because they renew quietly. Kakeibo makes the monthly picture obvious:

1. Add each subscription.
2. Set price, billing cycle, payment method, and next renewal date.
3. See monthly total and yearly projection.
4. Review upcoming renewals.
5. Pause or cancel subscriptions you no longer need.

## Features

- User authentication with Laravel session auth
- Add, edit, pause, cancel, and delete subscriptions
- Subscription fields: name, category, price, billing cycle, next renewal date, payment method, status, notes
- Dashboard metrics: monthly total, yearly projection, active subscriptions, upcoming renewals
- Subscription filters by status and category
- Renewal reminder simulation page
- CSV export for subscription data
- SQLite-first local demo setup
- Tailwind CDN Blade UI with sidebar, cards, tables, forms, and empty states

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel |
| Auth | Laravel session auth |
| UI | Blade, Tailwind CSS |
| Database | SQLite for local demo, MySQL/PostgreSQL optional |
| Email demo | Mailpit optional |
| Deployment | Render, Railway, Fly.io, or local demo |

## Screenshots

Add screenshots after the Laravel app is installed and running:

- `docs/screenshots/dashboard.png`
- `docs/screenshots/subscriptions.png`
- `docs/screenshots/upcoming-renewals.png`
- `docs/screenshots/empty-state.png`

## Local Setup

This folder contains the Laravel app source files. Dependencies are installed with Composer.

Recommended setup:

```bash
cd kakeibo
composer install
cp .env.example .env
type nul > database\database.sqlite
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Demo account after seeding:

- Email: `demo@kakeibo.test`
- Password: `password`

## Environment Variables

```env
APP_NAME=Kakeibo
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="Kakeibo"
```

## Demo Flow

1. Register a user.
2. Add subscriptions like `GitHub Pro`, `Domain renewal`, `Spotify`, and `Vercel`.
3. Open the dashboard.
4. Check monthly total and yearly projection.
5. Filter subscriptions by `active`.
6. Pause or cancel one subscription.
7. Open upcoming renewals to see what renews next.
8. Export subscriptions as CSV.

## Deployment Notes

- SQLite is easiest for local demos.
- Render, Railway, or Fly.io can host Laravel with PostgreSQL or MySQL.
- Keep reminders as a local simulation unless a real mail service is configured.
- Avoid paid services for the portfolio demo.

## Known Limitations

- Composer dependencies must be installed before running the app.
- Reminder email delivery is planned as a simulation first.

## Tests

```bash
php artisan test
```

## Planned Routes

| Method | Path | Purpose |
|---|---|---|
| `GET` | `/dashboard` | Subscription summary |
| `GET` | `/subscriptions` | Subscription list |
| `POST` | `/subscriptions` | Create subscription |
| `PATCH` | `/subscriptions/{subscription}` | Update subscription |
| `PATCH` | `/subscriptions/{subscription}/status` | Pause, activate, or cancel |
| `GET` | `/subscriptions/export` | Export subscriptions as CSV |
| `GET` | `/renewals` | Upcoming renewal reminder simulation |
