<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\BalaSeeder;
use Database\Factories\SubCategoryFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Brand::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            ColorImageSeeder::class,
            DiscountCodeSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            ProductImageSeeder::class,
            ProductSizeSeeder::class,
            ReviewSeeder::class,
            WishListSeeder::class,
        ]);
    }
}
