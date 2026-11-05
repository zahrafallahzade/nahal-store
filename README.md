# Nahal Store

An online store for board games and puzzles, built with Laravel and Bootstrap (RTL, Persian UI).
University project.

## Features
- Shop: product list with search and category filter, product page with reviews and ratings, cart, checkout, order history
- Auth: register, login and logout, user profile with address
- Profile updates (user, admin, manager) reject a phone number or username that belongs to another user
- Admin panel: products (with multiple images, activate/deactivate), categories, orders (bulk status update), users, review moderation with user ban
- Manager panel: dashboard, sales reports by category, user roles
- Role-based access (user, admin, manager) with route middleware; guests are redirected to login
- Cart checks: inactive or out-of-stock products cannot be added, and the product page shows an unavailable state
- Persian (RTL) interface and Persian validation messages
- Custom Persian error pages

## Tech
PHP 8.3, Laravel 13, MySQL, Bootstrap 5 (RTL), Blade

## Requirements
- PHP 8.3 or higher
- Composer
- MySQL

## Setup
```bash
git clone https://github.com/zahrafallahzade/nahal-store.git
cd nahal-store
composer install
cp .env.example .env
php artisan key:generate
# create a MySQL database named nahal-store, then:
php artisan migrate --seed
php artisan serve
```

## Default accounts
Created by `php artisan migrate --seed`:

| Role | Phone | Password |
|---|---|---|
| Admin | 09120000001 | admin123 |
| Manager | 09120000002 | manager123 |
| Customer | 09120000003 | customer123 |

For local development only. Change these passwords before any real deployment.

## Testing
```bash
php artisan test
```
Tests run on an in-memory SQLite database, so the `pdo_sqlite` PHP extension is required. Your MySQL data is not touched.

## Known limitations
- No payment gateway: the "Pay" button only creates the order.


## Roadmap
- Tests
- Mock payment page connected through an API
