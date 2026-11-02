<?php

namespace Tests\Feature;

use Tests\TestCase;

class GuestAccessTest extends TestCase    //تست دسترسی کاربری که لاگین نکرده (مهمان)
{
    public function test_guest_is_redirected_from_admin_panel_to_login(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_guest_is_redirected_from_manager_panel_to_login(): void
    {
        $response = $this->get('/manager/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_add_to_cart(): void     //مهمان نمی‌تواند محصول به سبد اضافه کند و باید به صفحه ورود برود
    {
        $response = $this->post('/cart/add/1', ['quantity' => 1]);

        $response->assertRedirect('/login');
    }

    public function test_guest_can_open_empty_profile_page(): void     //مهمان می‌تواند صفحه پروفایل (فرم خالی) را بدون خطا ببیند
    {
        $response = $this->get('/profile');

        $response->assertOk();
    }
}
