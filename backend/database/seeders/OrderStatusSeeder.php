<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('order_statuses')->insert([
            ['name' => 'Pendiente'],
            ['name' => 'Procesando'],
            ['name' => 'En reparto'],
            ['name' => 'Recoger en tienda'],
            ['name' => 'Completado'],
            ['name' => 'Cancelado'],
        ]);
    }
}

