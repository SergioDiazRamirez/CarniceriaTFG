<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'     => \App\Models\User::inRandomOrder()->first()->id,
            'address_id'  => \App\Models\Address::inRandomOrder()->first()->id,
            'status_id'   => 1, // o el que quieras
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
