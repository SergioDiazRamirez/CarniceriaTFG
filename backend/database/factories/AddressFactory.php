<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'full_address' => $this->faker->address,
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }
}
