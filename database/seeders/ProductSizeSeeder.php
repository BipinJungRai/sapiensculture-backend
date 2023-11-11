<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_sizes')->insert([
            'product_size' => 'XS',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('product_sizes')->insert([
            'product_size' => 'S',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('product_sizes')->insert([
            'product_size' => 'M',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('product_sizes')->insert([
            'product_size' => 'L',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('product_sizes')->insert([
            'product_size' => 'XL',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('product_sizes')->insert([
            'product_size' => 'XXL',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
