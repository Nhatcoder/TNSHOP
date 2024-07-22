<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 10),
            'name' => $name = $this->faker->sentence(2),
            'slug' => Str::slug($name),
            'meta_title' => $this->faker->sentence(2),
            'meta_description' => $this->faker->sentence(3),
            'meta_keywords' => $this->faker->sentence(3),
            'status' => $this->faker->numberBetween(0, 1),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),

       
        ];
    }
}
