<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;
use Illuminate\Database\QueryException;

class ProfileUpdateTest extends TestCase   //تست ویرایش اطلاعات حساب برای کاربر، ادمین و مدیر
{
    use RefreshDatabase;   //قبل از هر تست دیتابیس موقتی را از صفر می‌سازد

    private const ADDRESS = [   //فرم پروفایل فروشگاه این فیلدهای آدرس را هم لازم دارد
        'province' => 'Tehran',
        'city' => 'Tehran',
        'address' => 'Street 1',
        'plaque' => '1',
        'unit' => '1',
        'postal_code' => '1234567890',
    ];

    public static function panels(): array   //سه حالت: صفحه حساب، آدرس ذخیره، و فیلدهای اضافه هر نقش
    {
        return [
            'shop user' => ['user', '/profile', '/profile/update', self::ADDRESS],
            'admin' => ['admin', '/admin/account', '/admin/account/update', []],
            'manager' => ['manager', '/manager/account', '/manager/account/update', []],
        ];
    }

    private function makeUser(string $role, string $username, string $phone): User   //ساخت کاربر آزمایشی
    {
        return User::create([
            'first_name' => 'Ali',
            'last_name' => 'Rezaei',
            'username' => $username,
            'phone' => $phone,
            'password' => 'secret123',
            'role' => $role,
        ]);
    }

    private function formData(User $user, array $extra, array $override = []): array   //داده‌های فرم؛ پیش‌فرض اطلاعات خود کاربر است
    {
        return array_merge([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'username' => $user->username,
            'phone' => $user->phone,
        ], $extra, $override);
    }

    #[DataProvider('panels')]
    public function test_user_can_open_own_account_page(string $role, string $page, string $updateUrl, array $extra): void   //هر نقش صفحه حساب خودش را بدون خطا می‌بیند
    {
        $user = $this->makeUser($role, 'ali', '09120000001');

        $this->actingAs($user)->get($page)->assertOk();
    }

    #[DataProvider('panels')]
    public function test_name_change_is_saved(string $role, string $page, string $updateUrl, array $extra): void   //تغییر نام و نام خانوادگی قبول می‌شود و در دیتابیس ذخیره می‌شود
    {
        $user = $this->makeUser($role, 'ali', '09120000001');

        $response = $this->actingAs($user)->post($updateUrl, $this->formData($user, $extra, [
            'first_name' => 'Reza',
            'last_name' => 'Ahmadi',
        ]));

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'first_name' => 'Reza',
            'last_name' => 'Ahmadi',
        ]);
    }

    #[DataProvider('panels')]
    public function test_phone_of_another_user_is_rejected(string $role, string $page, string $updateUrl, array $extra): void   //شماره موبایل کاربر دیگر قبول نمی‌شود و دیتابیس تغییر نمی‌کند
    {
        $other = $this->makeUser('user', 'other', '09129999999');
        $user = $this->makeUser($role, 'ali', '09120000001');

        $response = $this->actingAs($user)->post($updateUrl, $this->formData($user, $extra, [
            'phone' => $other->phone,
        ]));

        $response->assertSessionHasErrors('phone');
        $this->assertDatabaseHas('users', ['id' => $user->id, 'phone' => '09120000001']);
    }

    #[DataProvider('panels')]
    public function test_username_of_another_user_is_rejected(string $role, string $page, string $updateUrl, array $extra): void   //نام کاربری کاربر دیگر قبول نمی‌شود و دیتابیس تغییر نمی‌کند
    {
        $other = $this->makeUser('user', 'other', '09129999999');
        $user = $this->makeUser($role, 'ali', '09120000001');

        $response = $this->actingAs($user)->post($updateUrl, $this->formData($user, $extra, [
            'username' => $other->username,
        ]));

        $response->assertSessionHasErrors('username');
        $this->assertDatabaseHas('users', ['id' => $user->id, 'username' => 'ali']);
    }

    #[DataProvider('panels')]
    public function test_own_phone_and_username_can_be_saved_again(string $role, string $page, string $updateUrl, array $extra): void   //ذخیره با شماره و نام کاربری خودش ارور نمی‌دهد
    {
        $user = $this->makeUser($role, 'ali', '09120000001');

        $response = $this->actingAs($user)->post($updateUrl, $this->formData($user, $extra));

        $response->assertSessionHasNoErrors();
    }

    public function test_admin_cannot_open_manager_account_page(): void   //ادمین نباید صفحه حساب مدیر را ببیند
    {
        $admin = $this->makeUser('admin', 'admin1', '09120000009');

        $this->actingAs($admin)->get('/manager/account')->assertForbidden();
    }

    public function test_database_rejects_duplicate_phone(): void   //خود دیتابیس باید شماره تکراری را رد کند، حتی بدون validate
    {
        $this->makeUser('user', 'first', '09120000001');

        $this->expectException(QueryException::class);

        $this->makeUser('user', 'second', '09120000001');
    }

    public function test_database_rejects_duplicate_username(): void   //خود دیتابیس باید نام کاربری تکراری را رد کند، حتی بدون validate
    {
        $this->makeUser('user', 'same', '09120000001');

        $this->expectException(QueryException::class);

        $this->makeUser('user', 'same', '09120000002');
    }
}
