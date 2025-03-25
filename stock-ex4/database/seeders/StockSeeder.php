<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stocks')->insert([
            [
                'product_name' => 'Product 1',
                'quantity' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Product 2',
                'quantity' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Product 3',
                'quantity' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Product 4',
                'quantity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Product 5',
                'quantity' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
