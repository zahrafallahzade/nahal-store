<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model{

    protected $fillable = [
        'user_id',
        'address_id',
        'shipping_cost',
        'total_price',
        'status',
        'ordered_at',
        'delivered_at',
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function orderItems(){

        return $this->hasMany(OrderItem::class);
    }

}
