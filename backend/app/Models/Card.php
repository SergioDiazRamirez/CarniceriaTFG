<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'user_id',
        'stripe_token',
        'brand',
        'last_4',
        'exp_month',
        'exp_year',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
