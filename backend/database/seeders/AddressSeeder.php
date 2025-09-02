<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Schema;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar la tabla antes de insertar
        // Schema::disableForeignKeyConstraints();
        // Address::truncate();
        // Schema::enableForeignKeyConstraints();

        // Para cada usuario existente, crear entre 1 y 3 direcciones
        User::all()->each(function ($user) {
            Address::factory()
                ->count(fake()->numberBetween(1, 3))
                ->create([
                    'user_id' => $user->id,
                ]);
        });
    }
}
