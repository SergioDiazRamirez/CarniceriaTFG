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

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}

