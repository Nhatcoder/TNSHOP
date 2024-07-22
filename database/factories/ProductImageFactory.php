<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "product_id" => Product::all()->random()->id,
            "image_name" => fake()->imageUrl(),
            "image_extension" => fake()->randomElement(['png', 'jpg', 'jpeg']),
            "order_by" => fake()->randomElement([1, 2, 3, 4, 100]),
            "created_at" => fake()->dateTime(),
            "updated_at" => fake()->dateTime(),
        ];
    }


}
