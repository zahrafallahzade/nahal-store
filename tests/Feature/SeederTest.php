<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeederTest extends TestCase   //تست داده‌های پیش‌فرض (Seeder)
{
    use RefreshDatabase;

    public function test_seeder_creates_default_accounts_with_correct_roles(): void   //سه حساب پیش‌فرض با نقش درست ساخته می‌شوند
    {
        $this->seed();

        $this->assertDatabaseHas('users', ['phone' => '09120000001', 'role' => 'admin']);
        $this->assertDatabaseHas('users', ['phone' => '09120000002', 'role' => 'manager']);
        $this->assertDatabaseHas('users', ['phone' => '09120000003', 'role' => 'user']);
    }

    public function test_seeded_customer_has_an_address(): void   //مشتری نمونه آدرس دارد تا بتواند خرید را امتحان کند
    {
        $this->seed();

        $customer = User::where('phone', '09120000003')->first();

        $this->assertNotNull($customer->address);
    }

    public function test_seeded_admin_can_login_with_default_password(): void   //ادمین پیش‌فرض با رمز پیش‌فرض می‌تواند وارد شود
    {
        $this->seed();

        $this->post('/login', ['phone' => '09120000001', 'password' => 'admin123']);

        $this->assertAuthenticated();
    }

    public function test_seeder_creates_categories_and_active_products(): void   //دسته‌ها و محصولات نمونه، همه فعال
    {
        $this->seed();

        $this->assertDatabaseCount('categories', 3);
        $this->assertDatabaseCount('products', 6);
        $this->assertSame(0, Product::where('is_active', false)->count());
    }

    public function test_running_seeder_twice_does_not_create_duplicates(): void   //اجرای دوباره Seeder داده تکراری نمی‌سازد
    {
        $this->seed();
        $this->seed();

        $this->assertDatabaseCount('users', 3);
        $this->assertDatabaseCount('categories', 3);
        $this->assertDatabaseCount('products', 6);
    }
}
