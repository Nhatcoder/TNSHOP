<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WishList>
 */
class WishListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=> User::all()->random()->id,
            'product_id'=> Product::all()->random()->id,
            "created_at" => fake()->dateTimeBetween('-6 months', 'now'),
            "updated_at" => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
