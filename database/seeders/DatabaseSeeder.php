<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void   //با php artisan db:seed یا migrate --seed اجرا می‌شود
    {
        $this->call([
            UserSeeder::class,
            ShopSeeder::class,
        ]);
    }
}
