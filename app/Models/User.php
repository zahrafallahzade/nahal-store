<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;    //قابلیت‌های لازم برای احراز هویت Laravel را به مدل User می‌دهد
use Illuminate\Notifications\Notifiable;


#[Hidden(['password', 'remember_token'])]    //یعنی دوتا از اطلاعات حساس کاربر توی خروجی نمایش نده
class User extends Authenticatable{

    use HasFactory, Notifiable;
    //برای ساختن نمونه‌های آزمایشی از کاربران، معمولاً در Factory و تست‌ها استفاده می‌شود
    //قابلیت Notification یا اعلان‌های Laravel را برای کاربر فراهم می‌کند

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'banned_at' => 'datetime',
        ];
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'phone',
        'email',
        'password',
        'role',
        'is_banned',
        'bad_reviews_count',
        'banned_at',
    ];

    public function address(){

        return $this->hasOne(Address::class);
    }

    public function isCurrentlyBanned(){

        if (!$this->is_banned) {
            return false;
        }
        return $this->banned_at && $this->banned_at->diffInDays(now()) < 7;
    }
}
