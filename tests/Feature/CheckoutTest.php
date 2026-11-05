<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase   //تست ثبت سفارش: قیمت، موجودی و سبد خرید
{
    use RefreshDatabase;

    private function makeUser(bool $withAddress = true): User   //ساخت کاربر آزمایشی؛ به‌صورت پیش‌فرض آدرس هم دارد
    {
        $user = User::create([
            'first_name' => 'Ali',
            'last_name' => 'Rezaei',
            'username' => 'ali',
            'phone' => '09120000001',
            'password' => 'secret123',
            'role' => 'user',
        ]);

        if ($withAddress) {
            Address::create([
                'user_id' => $user->id,
                'province' => 'Tehran',
                'city' => 'Tehran',
                'address' => 'Street 1',
                'plaque' => '1',
                'unit' => '1',
                'postal_code' => '1234567890',
            ]);
        }

        return $user;
    }

    private function makeProduct(int $price = 100000, int $stock = 5, bool $active = true): Product   //ساخت محصول آزمایشی با قیمت، موجودی و وضعیت دلخواه
    {
        $category = Category::create(['name' => 'Puzzle']);

        return Product::create([
            'category_id' => $category->id,
            'name' => 'Test product',
            'description' => 'Test',
            'price' => $price,
            'stock' => $stock,
            'is_active' => $active,
        ]);
    }

    private function addToCart(User $user, Product $product, int $quantity): void   //اضافه کردن محصول به سبد کاربر
    {
        CartItem::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);
    }

    public function test_checkout_creates_order_with_stored_price_and_decreases_stock(): void   //خرید موفق: سفارش ساخته می‌شود، قیمت ذخیره می‌شود، موجودی کم می‌شود و سبد خالی می‌شود
    {
        $user = $this->makeUser();
        $product = $this->makeProduct(100000, 5);
        $this->addToCart($user, $product, 2);

        $response = $this->actingAs($user)->post('/checkout');

        $response->assertRedirect('/orders');
        $this->assertDatabaseHas('orders', ['user_id' => $user->id, 'status' => 'pending', 'total_price' => 250000]);
        $this->assertDatabaseHas('order_items', ['product_id' => $product->id, 'quantity' => 2, 'price' => 100000]);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 3]);
        $this->assertDatabaseMissing('cart_items', ['user_id' => $user->id]);
    }

    public function test_stored_price_does_not_change_when_product_price_changes(): void   //تغییر قیمت محصول بعد از خرید، قیمت ثبت‌شده در سفارش را عوض نمی‌کند
    {
        $user = $this->makeUser();
        $product = $this->makeProduct(100000, 5);
        $this->addToCart($user, $product, 1);

        $this->actingAs($user)->post('/checkout');

        $product->update(['price' => 150000]);

        $this->assertDatabaseHas('order_items', ['product_id' => $product->id, 'price' => 100000]);
    }

    public function test_checkout_fails_and_rolls_back_when_stock_is_not_enough(): void   //موجودی کم: خطا می‌دهد و هیچ سفارش نصفه‌نیمه‌ای در دیتابیس نمی‌ماند
    {
        $user = $this->makeUser();
        $product = $this->makeProduct(100000, 1);
        $this->addToCart($user, $product, 2);

        $response = $this->actingAs($user)->post('/checkout');

        $response->assertSessionHas('error');
        $this->assertDatabaseCount('orders', 0);
        $this->assertDatabaseCount('order_items', 0);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 1]);
        $this->assertDatabaseHas('cart_items', ['user_id' => $user->id]);
    }

    public function test_checkout_fails_when_product_is_inactive(): void   //محصول غیرفعال قابل خرید نیست
    {
        $user = $this->makeUser();
        $product = $this->makeProduct(100000, 5, false);
        $this->addToCart($user, $product, 1);

        $response = $this->actingAs($user)->post('/checkout');

        $response->assertSessionHas('error');
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_checkout_fails_when_cart_is_empty(): void   //سبد خالی سفارش نمی‌سازد
    {
        $user = $this->makeUser();

        $response = $this->actingAs($user)->post('/checkout');

        $response->assertSessionHas('error');
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_checkout_fails_when_user_has_no_address(): void   //کاربر بدون آدرس سفارش نمی‌سازد
    {
        $user = $this->makeUser(false);
        $product = $this->makeProduct();
        $this->addToCart($user, $product, 1);

        $response = $this->actingAs($user)->post('/checkout');

        $response->assertSessionHas('error');
        $this->assertDatabaseCount('orders', 0);
    }
}
