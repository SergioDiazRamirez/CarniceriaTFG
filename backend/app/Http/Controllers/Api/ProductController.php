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

