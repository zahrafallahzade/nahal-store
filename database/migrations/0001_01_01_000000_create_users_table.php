<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('phone');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['user', 'admin', 'manager']);
            $table->rememberToken();      //پرسش مرا به خاطر بسپار
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {   //برای زمانی که کاربر رمزش رو فراموش کرده و رمز جدید میخواد بگیره
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {    //وقتی وارد سایت می‌شوی، Laravel باید بتواند وضعیت ورود تو را در طول کار با سایت حفظ کند
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();    //جست‌وجو سریع‌تر انجام بشه
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
