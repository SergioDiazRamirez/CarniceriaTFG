<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => \App\Models\Product::inRandomOrder()->first()->id,
            'quantity'   => $this->faker->numberBetween(1, 5),
            'weight'    => $this->faker->randomElement([0.250, 0.5, 0.75, 1, 2]),
            'total_price' => $this->faker->randomFloat(2, 5, 40),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
