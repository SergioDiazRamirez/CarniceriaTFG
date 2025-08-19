<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $queryProducts = Product::with('categories');
        // Solo devuelve productos favoritos del usuario autenticado
        if($request->query('favorites') == '1') {
            if(auth()->user() === null)   
                return response()->json(['error' => 'Unauthorized'], 401);

            $user = $request->user();
            if ($user) {
                $queryProducts->whereHas('favoritedBy', function ($q) use ($user) {
                    $q->where('users.id', $user->id);
                });
            }
        }
                
        // Filtro nombre
        if ($search = $request->query('search')) {
            $queryProducts->where('name', 'like', "%{$search}%");
        }

        // Filtro categoría por id
        if ($categoryId = $request->query('category_id')) {
            $queryProducts->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }

        // Orden (opcional)
        if ($sort = $request->query('sort')) {
            // Ejemplo: price_asc, price_desc
            if ($sort === 'price_asc') $queryProducts->orderBy('price', 'asc');
            elseif ($sort === 'price_desc') $queryProducts->orderBy('price', 'desc');
        }

        $perPage = 8;
        return $queryProducts->paginate($perPage);
    }
}
