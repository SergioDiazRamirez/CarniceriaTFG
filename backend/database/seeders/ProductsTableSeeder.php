<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Costilla de Cerdo',
                'ingredients' => 'Costilla de cerdo marinada',
                'description' => 'Costillas jugosas vendidas por peso.',
                'price' => 12.50,
                'stock' => 50.500, // kilos en stock
                'sale_type_id' => 1, // Por peso
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hamburguesa Clásica',
                'ingredients' => 'Carne de res 100% vacuno',
                'description' => 'Una deliciosa hamburguesa clásica con ingredientes frescos.',
                'price' => 5.99,
                'stock' => 100.000, // kilos
                'sale_type_id' => 2, // Por unidades
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chuletón de Vaca Rubia',
                'ingredients' => 'Chuletón de Vaca Rubia Gallega',
                'description' => 'Un chuletón de alta calidad, ideal para los amantes de la carne.',
                'price' => 20.00,
                'stock' => 30.750,
                'sale_type_id' => 3, // Peso + unidades
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
