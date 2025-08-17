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
            ['id' => 1, 'name' => 'Costilla de ternera', 'ingredients' => 'Costilla de ternera marinada', 'description' => 'Costillas jugosas vendidas por peso.', 'price' => 12.50, 'stock' => 50.500, 'sale_type_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Producto: Costilla de ternera 
            ['id' => 2, 'name' => 'Hamburguesa Clásica', 'ingredients' => 'Carne de res 100% vacuno', 'description' => 'Una deliciosa hamburguesa clásica con ingredientes frescos.', 'price' => 5.99, 'stock' => 100.000, 'sale_type_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Producto: Hamburguesa Clásica 
            ['id' => 3, 'name' => 'Chuletón de Vaca Rubia', 'ingredients' => 'Chuletón de Vaca Rubia Gallega', 'description' => 'Un chuletón de alta calidad, ideal para los amantes de la carne.', 'price' => 20.00, 'stock' => 30.750, 'sale_type_id' => 3, 'created_at' => now(), 'updated_at' => now()], // Producto: Chuletón de Vaca Rubia 
            ['id' => 4, 'name' => 'Pechuga de Pollo', 'ingredients' => 'Pechuga de pollo fresca', 'description' => 'Pechuga jugosa y sin piel, ideal para asar o freír.', 'price' => 7.50, 'stock' => 80.000, 'sale_type_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Producto: Pechuga de Pollo 
            ['id' => 5, 'name' => 'Conejo Entero', 'ingredients' => 'Conejo fresco de granja', 'description' => 'Conejo entero listo para cocinar.', 'price' => 11.20, 'stock' => 25.300, 'sale_type_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Producto: Conejo Entero 
            ['id' => 6, 'name' => 'Entrecot de Ternera', 'ingredients' => 'Entrecot de ternera nacional', 'description' => 'Corte tierno y jugoso de ternera.', 'price' => 18.90, 'stock' => 40.000, 'sale_type_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Producto: Entrecot de Ternera 
            ['id' => 7, 'name' => 'Hamburguesa de Pollo', 'ingredients' => 'Carne de pollo picada', 'description' => 'Hamburguesa ligera y sabrosa, perfecta para la plancha.', 'price' => 4.50, 'stock' => 60.000, 'sale_type_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Producto: Hamburguesa de Pollo 
            ['id' => 8, 'name' => 'Alitas de Pollo', 'ingredients' => 'Alitas de pollo marinadas', 'description' => 'Perfectas para barbacoa o freír.', 'price' => 6.90, 'stock' => 70.000, 'sale_type_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Producto: Alitas de Pollo 
            ['id' => 9, 'name' => 'Chuletón de Ávila', 'ingredients' => 'Chuletón de vaca Ávila', 'description' => 'Carne tierna con gran sabor.', 'price' => 21.50, 'stock' => 20.000, 'sale_type_id' => 3, 'created_at' => now(), 'updated_at' => now()], // Producto: Chuletón de Ávila 
            ['id' => 10, 'name' => 'Filetes de Ternera', 'ingredients' => 'Filete magro de ternera', 'description' => 'Filetes finos para plancha.', 'price' => 15.00, 'stock' => 55.000, 'sale_type_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Producto: Filetes de Ternera 
            ['id' => 11, 'name' => 'Muslos de Pollo', 'ingredients' => 'Muslo de pollo fresco', 'description' => 'Muslos tiernos y jugosos.', 'price' => 5.80, 'stock' => 90.000, 'sale_type_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Producto: Muslos de Pollo 
            ['id' => 12, 'name' => 'Hamburguesa Gourmet', 'ingredients' => 'Mezcla de ternera y cerdo con especias', 'description' => 'Hamburguesa premium para paladares exigentes.', 'price' => 6.80, 'stock' => 50.000, 'sale_type_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Producto: Hamburguesa Gourmet 
            ['id' => 13, 'name' => 'Conejo Troceado', 'ingredients' => 'Conejo de granja troceado', 'description' => 'Listo para guisar o paella.', 'price' => 12.00, 'stock' => 30.000, 'sale_type_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Producto: Conejo Troceado 
            ['id' => 14, 'name' => 'Carne Picada de Ternera', 'ingredients' => 'Carne de ternera 100% magra', 'description' => 'Perfecta para albóndigas o boloñesa.', 'price' => 9.50, 'stock' => 100.000, 'sale_type_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Producto: Carne Picada de Ternera 
            ['id' => 15, 'name' => 'Chuletón Premium', 'ingredients' => 'Chuletón de vaca vieja madurada', 'description' => 'Sabor intenso para amantes de la carne.', 'price' => 25.00, 'stock' => 15.000, 'sale_type_id' => 3, 'created_at' => now(), 'updated_at' => now()], // Producto: Chuletón Premium 
            ['id' => 16, 'name' => 'Pechuga de Pollo Adobada', 'ingredients' => 'Pechuga de pollo marinada en especias', 'description' => 'Listas para cocinar a la plancha.', 'price' => 8.20, 'stock' => 65.000, 'sale_type_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Producto: Pechuga de Pollo Adobada 
            ['id' => 17, 'name' => 'Solomillo de Ternera', 'ingredients' => 'Solomillo fresco de ternera', 'description' => 'Corte tierno y jugoso, calidad extra.', 'price' => 28.00, 'stock' => 12.000, 'sale_type_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Producto: Solomillo de Ternera 
            ['id' => 18, 'name' => 'Brochetas de Pollo', 'ingredients' => 'Trozos de pollo marinados y ensartados', 'description' => 'Perfectas para barbacoas.', 'price' => 7.80, 'stock' => 40.000, 'sale_type_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Producto: Brochetas de Pollo 
            ['id' => 19, 'name' => 'Hamburguesa Vegetal', 'ingredients' => 'Proteína vegetal, especias', 'description' => 'Opción sin carne, ideal para veganos.', 'price' => 4.90, 'stock' => 50.000, 'sale_type_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Producto: Hamburguesa Vegetal 
        ]);

        // Asignar categorías a productos
        DB::table('category_product')->insert([
            ['category_id' => 4, 'product_id' => 1], // ternera - Costilla de ternera
            ['category_id' => 2, 'product_id' => 2], // hamburguesas - Hamburguesa Clásica
            ['category_id' => 4, 'product_id' => 2], // ternera - Hamburguesa Clásica
            ['category_id' => 1, 'product_id' => 3], // chuletones - Chuletón de Vaca Rubia
            ['category_id' => 3, 'product_id' => 4], // pollo - Pollo Asado Entero
            ['category_id' => 5, 'product_id' => 5], // conejo - Conejo al Ajillo
            ['category_id' => 4, 'product_id' => 6], // ternera - Filete de Ternera
            ['category_id' => 2, 'product_id' => 7], // hamburguesas - Hamburguesa de Pollo
            ['category_id' => 3, 'product_id' => 7], // pollo - Hamburguesa de Pollo
            ['category_id' => 3, 'product_id' => 8], // pollo - Pechuga de Pollo
            ['category_id' => 1, 'product_id' => 9], // chuletones - Chuletón de Buey
            ['category_id' => 4, 'product_id' => 10], // ternera - Entrecot de Ternera
            ['category_id' => 3, 'product_id' => 11], // pollo - Alitas BBQ
            ['category_id' => 2, 'product_id' => 12], // hamburguesas - Hamburguesa Gourmet
            ['category_id' => 4, 'product_id' => 12], // ternera - Hamburguesa Gourmet
            ['category_id' => 5, 'product_id' => 13], // conejo - Estofado de Conejo
            ['category_id' => 4, 'product_id' => 14], // ternera - Solomillo de Ternera
            ['category_id' => 1, 'product_id' => 15], // chuletones - Chuletón de Angus
            ['category_id' => 3, 'product_id' => 16], // pollo - Muslos de Pollo
            ['category_id' => 4, 'product_id' => 17], // ternera - Carne Picada de Ternera
            ['category_id' => 3, 'product_id' => 18], // pollo - Pollo al Curry
            ['category_id' => 2, 'product_id' => 19], // hamburguesas - Hamburguesa Vegana
        ]);
    }
}
