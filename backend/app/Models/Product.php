<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'ingredients',
        'description',
        'price',
        'stock',
        'image',
        'sale_type_id',
    ];
    protected $appends = ['isFavorite'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function favoritedBy() {
        return $this->belongsToMany(User::class, 'favorite_user_product', 'product_id', 'user_id');
    }

    public function getIsFavoriteAttribute()
    {
        $user = auth()->user();
        return $user ? $user->favoriteProducts()->where('product_id', $this->id)->exists() : false;
    }
}

