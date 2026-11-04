<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void   //اجرای migration: قفل یکتایی روی شماره و نام کاربری
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unique('phone');
            $table->unique('username');
        });
    }

    public function down(): void   //برگرداندن migration: برداشتن قفل‌ها
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['phone']);
            $table->dropUnique(['username']);
        });
    }
};
