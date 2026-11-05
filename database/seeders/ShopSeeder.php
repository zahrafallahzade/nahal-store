<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder   //دسته‌بندی‌ها و محصولات نمونه
{
    public function run(): void
    {
        $categories = [
            'پازل' => [
                ['name' => 'پازل ۵۰۰ تکه', 'description' => 'پازل ۵۰۰ تکه با تصویر طبیعت', 'price' => 250000, 'stock' => 12],
                ['name' => 'پازل ۱۰۰۰ تکه', 'description' => 'پازل ۱۰۰۰ تکه مناسب بزرگسالان', 'price' => 420000, 'stock' => 8],
            ],
            'لگو' => [
                ['name' => 'لگو ماشین', 'description' => 'مجموعه لگو ساخت ماشین', 'price' => 600000, 'stock' => 5],
                ['name' => 'لگو قلعه', 'description' => 'مجموعه لگو ساخت قلعه', 'price' => 850000, 'stock' => 3],
            ],
            'بازی فکری' => [
                ['name' => 'بازی کاتان', 'description' => 'بازی فکری استراتژیک خانوادگی', 'price' => 950000, 'stock' => 6],
                ['name' => 'بازی دورهمی', 'description' => 'بازی گروهی مناسب مهمانی', 'price' => 380000, 'stock' => 10],
            ],
        ];

        foreach ($categories as $categoryName => $products) {
            $category = Category::firstOrCreate(['name' => $categoryName]);

            foreach ($products as $product) {
                Product::firstOrCreate(
                    ['name' => $product['name']],
                    $product + ['category_id' => $category->id, 'is_active' => true]
                );
            }
        }
    }
}
