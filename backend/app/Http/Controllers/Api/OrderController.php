<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Devuelve los pedidos del usuario autenticado.
     */
    public function userOrders()
    {
        $user = Auth::user();

        $orders = Order::with(['orderItems.product', 'orderStatus'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($order) {
                $totalPrice = $order->orderItems->sum('total_price');

                return [
                    'id' => $order->id,
                    'created_at' => $order->created_at,
                    'total_price' => $totalPrice,
                    'status_id' => $order->orderStatus->id, 
                ];
            });

        return response()->json($orders);
    }

    /**
     * Devuelve el detalle de un pedido del usuario autenticado.
     */
    public function show(Order $order)
    {
        $user = Auth::user();

        if ($order->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $order->load(['orderItems.product', 'orderStatus', 'address']);

        $items = $order->orderItems->map(function($item) {
            return [
                'product_id' => $item->product->id,
                'name' => $item->product->name,
                'quantity' => $item->quantity,
                'weight' => $item->weight,
                'total_price' => $item->total_price,
            ];
        });

        $totalPrice = $items->sum('total_price');

        return response()->json([
            'id' => $order->id,
            'created_at' => $order->created_at,
            'status_id' => $order->orderStatus->id,
            'total_price' => $totalPrice,
            'items' => $items,
            'delivery_address' => $order->address ? $order->address->full_address : null,
        ]);
    }
}
