# Nahal Store

An online store for board games and puzzles, built with Laravel and Bootstrap (RTL, Persian UI).
University project.

## Features
- Shop: product list with search and category filter, product page with reviews and ratings, cart, checkout, order history
- Auth: register and login, user profile with address
- Admin panel: products (with multiple images, activate/deactivate), categories, orders (bulk status update), users, review moderation with user ban
- Manager panel: dashboard, sales reports by category, user roles
- Persian (RTL) interface and Persian validation messages

## Tech
PHP 8.3, Laravel 13, MySQL, Bootstrap 5 (RTL), Blade

## Requirements
- PHP 8.3 or higher
- Composer
- MySQL

## Setup
bash
git clone https://github.com/zahrafallahzade/nahal-store.git
cd nahal-store
composer install
cp .env.example .env
php artisan key:generate
# create a MySQL database named nahal-store, then:
php artisan migrate
php artisan serve


## Known limitations
- No payment gateway: the "Pay" button only creates the order.
- Admin/manager routes are not protected by middleware yet.
- Product stock is not decreased on checkout.
- Database seeder is not finished.
- No default admin account: set a user's role manually in the database.

## Roadmap
- Role middleware, upload validation, logout
- Store item price at purchase time
- Tests
