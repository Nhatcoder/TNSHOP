<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiscountCode>
 */
class DiscountCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=> fake()->name(),
            "name_code"=> Str::upper(Str::random(10)),
            "type"=> fake()->randomElement(['amount', 'percent']),
            "amount"=> fake()->numberBetween(1000, 100000),
            "expire_date"=> now()->addDays(30),
            "status"=> fake()->numberBetween(0, 1),
            "created_at"=> fake()->dateTime(),
            "updated_at"=> fake()->dateTime(),
        ];
            
    }
}
