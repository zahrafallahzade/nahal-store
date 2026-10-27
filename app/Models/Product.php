<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    protected $fillable = [   //فیلد های قابل پر شدن برای هر محصول
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);  //هرمحصول مربوط به یک دسته بندی است
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);  //هر محصول شامل چند عکس است
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
