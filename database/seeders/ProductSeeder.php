<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ایجاد 3 محصول با قیمت‌های مشخص
        Product::create([
            'title' => 'Product 1',
            'price' => 1,
            'caption' => 'lorem ipsum dolor sit amet',
            'image' => 'product-1.jpg',
            'image_thumbnail' => 'product-1.jpg',
            'status' => 1,
            'stock' => 7,
        ]);

        Product::create([
            'title' => 'Product 2',
            'price' => 10,
            'caption' => 'lorem ipsum dolor sit amet',
            'image' => 'product-2.jpg',
            'image_thumbnail' => 'product-2.jpg',
            'status' => 1,
            'stock' => 5,
        ]);

        Product::create([
            'title' => 'Product 3',
            'price' => 100,
            'caption' => 'lorem ipsum dolor sit amet',
            'image' => 'product-3.jpg',
            'image_thumbnail' => 'product-3.jpg',
            'status' => 0,
            'stock' => 4,
        ]);

        // ایجاد 17 محصول دیگر با استفاده از Factory
        Product::factory()->count(7)->create();
    }
}
