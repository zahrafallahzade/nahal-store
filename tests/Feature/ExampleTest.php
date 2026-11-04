<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;   //دیتابیس موقتی را با migration ها می‌سازد، چون صفحه اصلی محصولات را از دیتابیس می‌خواند

    public function test_the_application_returns_a_successful_response(): void   //صفحه اصلی بدون خطا باز می‌شود
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
