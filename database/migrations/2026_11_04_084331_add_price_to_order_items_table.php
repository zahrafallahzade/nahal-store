<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void   //ستون قیمت لحظه خرید برای اقلام سفارش
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->integer('price')->default(0)->after('quantity');
        });

        DB::statement('UPDATE order_items SET price = COALESCE((SELECT price FROM products WHERE products.id = order_items.product_id), 0)');   //سفارش‌های قدیمی: قیمت فعلی محصول
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
};
