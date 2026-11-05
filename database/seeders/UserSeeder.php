<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder   //حساب‌های پیش‌فرض برای اجرای محلی پروژه
{
    public function run(): void
    {
        User::firstOrCreate(
            ['phone' => '09120000001'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Nahal',
                'username' => 'admin',
                'password' => 'admin123',
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['phone' => '09120000002'],
            [
                'first_name' => 'Manager',
                'last_name' => 'Nahal',
                'username' => 'manager',
                'password' => 'manager123',
                'role' => 'manager',
            ]
        );

        $customer = User::firstOrCreate(
            ['phone' => '09120000003'],
            [
                'first_name' => 'Customer',
                'last_name' => 'Nahal',
                'username' => 'customer',
                'password' => 'customer123',
                'role' => 'user',
            ]
        );

        Address::firstOrCreate(
            ['user_id' => $customer->id],
            [
                'province' => 'Tehran',
                'city' => 'Tehran',
                'address' => 'Sample street',
                'plaque' => '1',
                'unit' => '1',
                'postal_code' => '1234567890',
            ]
        );
    }
}
