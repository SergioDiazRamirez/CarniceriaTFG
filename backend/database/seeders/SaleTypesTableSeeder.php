<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sale_types')->insert([
            [
                'id' => 1,
                'name' => 'weight',
                'description' => 'Productos vendidos por peso',
            ],
            [
                'id' => 2,
                'name' => 'quantity',
                'description' => 'Productos vendidos por unidades',
            ],
            [
                'id' => 3,
                'name' => 'weight_and_quantity',
                'description' => 'Productos vendidos por peso por unidad más unidades',
            ],
        ]);
    }
}
