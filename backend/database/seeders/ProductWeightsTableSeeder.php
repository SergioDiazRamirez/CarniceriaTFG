<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductWeightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_weights')->insert([
            [
                'product_id' => 1, // ID del producto al que pertenece este peso
                'description' => '1 kg',
                'weight' => 1.000, // 1 kg
            ],
            [
                'product_id' => 1, // ID del producto al que pertenece este peso
                'description' => '500 g',
                'weight' => 0.500, // 500 g
            ],
            [
                'product_id' => 1, // ID del producto al que pertenece este peso
                'description' => '250 g',
                'weight' => 0.250, // 250 g
            ],
            [
                'product_id' => 3, // ID del producto al que pertenece este peso
                'description' => '1 kg',
                'weight' => 1.000, // 1 kg
            ],
            [
                'product_id' => 3, // ID del producto al que pertenece este peso
                'description' => '1.5 kg',
                'weight' => 1.500, // 1.5 kg
            ],
        ]);
    }
}
