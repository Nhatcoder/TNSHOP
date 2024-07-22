<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\DiscountCode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $discountCodes = DiscountCode::all();
        return [
            "user_id" => User::factory()->create()->id,
            "code_order" => Str::upper(Str::random(10)),
            "name" => fake()->name(),
            "phone" => fake()->phoneNumber(),
            "city" => fake()->city(),
            "district" => fake()->city(),
            "ward" => fake()->state(),
            "home_address" => fake()->address(),
            "discount_code" => $discountCodes->isNotEmpty() ? $discountCodes->random()->name_code : null,
            "total_price" => fake()->numberBetween(100000, 1000000),
            "total_amount" => fake()->numberBetween(100000, 1000000),
            "shipping_id" => fake()->numberBetween(1, 3),
            "note" => fake()->paragraph(5),
            "payment" => fake()->randomElement(['tienmat', 'momo', 'vnpay']),
            "status" => fake()->numberBetween(0, 1),
            "is_review" => fake()->numberBetween(0, 1),
            "created_at" => fake()->dateTimeBetween('-6 months', 'now'),
            "updated_at" => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
