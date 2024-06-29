<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Kemeja Allasan Hitam',
                'slug' => Str::slug('kemeja-alasan-hitam'),
                'desc' => 'Description for Product 1',
                'price' => 250000,
                'stok' => 50,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tunik Shimmer Sage',
                'slug' => Str::slug('tunik-shimmer-sage'),
                'desc' => 'Description for Product 2',
                'price' => 350000,
                'stok' => 30,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Celana Chino All Size',
                'slug' => Str::slug('celana-chino-all-size'),
                'desc' => 'Description for Product 3',
                'price' => 200000,
                'stok' => 20,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
