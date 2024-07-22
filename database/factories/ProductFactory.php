<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => $title = fake()->sentence(2),
            "slug" => Str::slug($title),
            "category_id" => Category::all()->random()->id,
            "brand_id" => Brand::all()->random()->id,
            "sub_category_id" => Subcategory::all()->random()->id,
            "old_price" => fake()->numberBetween(100000, 1000000),
            "price" => fake()->numberBetween(100000, 1000000),
            "short_description" => fake()->sentence(5),
            "description" => fake()->paragraph(5),
            "additional_information" => fake()->paragraph(5),
            "shipping_returns" => fake()->paragraph(5),
            "hot" => fake()->numberBetween(0, 1),
            "status" => fake()->numberBetween(0, 1),
            "is_delete" => fake()->numberBetween(0, 1),
            "created_at" => fake()->dateTime(),
            "updated_at" => fake()->dateTime(),

        ];
    }
}
