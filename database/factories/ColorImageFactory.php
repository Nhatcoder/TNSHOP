<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;


class ColorImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "color_name" => fake()->sentence(2),
            "image_name" => fake()->imageUrl(),
            "product_id" => Product::all()->random()->id,
            "created_at" => fake()->dateTime(),
            "updated_at" => fake()->dateTime(),
        ];
    }
}
