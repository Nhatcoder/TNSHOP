<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSize>
 */
class ProductSizeFactory extends Factory
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
            "name" => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            "price" => $this->faker->numberBetween(['1000', '10000']),
            "created_at" => fake()->dateTime(),
            "updated_at" => fake()->dateTime(),
        ];
    }
}
