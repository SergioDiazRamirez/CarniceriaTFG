<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Crear 4 pedidos
        Order::factory()
            ->count(4)
            ->create()
            ->each(function ($order) {
                // Para cada pedido, crear entre 5 y 8 items
                OrderItem::factory()
                    ->count(rand(5, 8))
                    ->create([
                        'order_id' => $order->id,
                    ]);
            });
    }
}
