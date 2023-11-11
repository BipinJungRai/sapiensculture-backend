<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\DeliveryFee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();
         DeliveryFee::factory(50)->create();

        //Category::factory(10)->create();

        $this->call([
            ProductSizeSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
        ]);
    }
}
