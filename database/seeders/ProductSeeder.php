<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;


class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Mảng kích thước sản phẩm
        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];

        // Tạo 15 sản phẩm
        for ($i = 0; $i < 15; $i++) {
            Product::create([
                "title" => "Product $i",
                "slug" => "product-$i",
                "category_id" => 6,
                "brand_id" => 4,
                "old_price" => 2000000,
                "price" => 100000,
                "created_at" => now(),
                "updated_at" => now(),
            ]);

            // Tạo 5 ảnh cho mỗi sản phẩm
            // for ($j = 1; $j <= 5; $j++) {
            //     ProductImage::create([
            //         'product_id' => $product->id,
            //         'image_name' => "https://img.fantaskycdn.com/product-$i-image-$j.jpg", // URL ảnh
            //         'order_by' => $j,
            //     ]);
            // }

            // // Tạo kích thước cho mỗi sản phẩm
            // foreach ($sizes as $size) {
            //     ProductSize::create([
            //         'product_id' => $product->id,
            //         'name' => $size,
            //         'price' => 10000, // Giá cố định cho mỗi kích thước
            //     ]);
            // }

            // // Tạo màu sắc cho mỗi sản phẩm
            // for ($color = 1; $color <= 5; $color++) {
            //     ProductColor::create([
            //         'product_id' => $product->id,
            //         'image_name' => "color-$color.jpg", // Tên ảnh màu sắc
            //     ]);
            // }
        }
    }
}
