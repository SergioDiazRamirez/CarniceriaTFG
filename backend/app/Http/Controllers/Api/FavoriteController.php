<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user(); 

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $perPage = 8;

        // Productos favoritos del usuario con las categorías
        $paginated = $user->favoriteProducts()->with('categories')->paginate($perPage);

        // El accessor getIsFavoriteAttribute añade el campo isFavorite a cada producto al pasarlo a json
        return response()->json($paginated);
    }

    // Agregar un favorito
    public function store(Request $request)
    {
        $productId = $request->input('product_id');
        $user = Auth::user();

        $user->favoriteProducts()->syncWithoutDetaching([$productId]);

        return response()->json([
            'success' => true,
            'message' => 'Producto añadido a favoritos',
        ]);
    }

    // Quitar un favorito
    public function destroy($productId)
    {
        $user = Auth::user();
        $user->favoriteProducts()->detach($productId);

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado de favoritos',
        ]);
    }
}

