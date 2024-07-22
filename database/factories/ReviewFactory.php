<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
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
            "user_id" => User::all()->random()->id,
            "order_id" => Order::all()->random()->id,
            "comment" => $this->faker->paragraph(),
            "rating" => $this->faker->numberBetween(1, 5),
            "created_at" => fake()->dateTimeBetween('-6 months', 'now'),
            "updated_at" => fake()->dateTimeBetween('-6 months', 'now'), 
        ];
    }


}
