<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          "order_id"=>Order::all()->random()->id,
          "product_id"=>Product::all()->random()->id,
          "quantity"=>fake()->numberBetween(1, 10),
          "price"=>fake()->numberBetween(100000, 1000000),
          "size_name"=>fake()->sentence(2),
          "color_name"=>fake()->sentence(2),
          "size_amount"=>fake()->numberBetween(1, 10),
          "total_price"=>fake()->numberBetween(100000, 1000000),
          "created_at"=>fake()->dateTime(),
          "updated_at"=>fake()->dateTime(),
        ];
    }
}
