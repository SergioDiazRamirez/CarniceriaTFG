<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // User::create([
        //     'name' => 'Sergio (asd)',
        //     'email' => 'sergio@hotmail.com',
        //     'password' => Hash::make('asd'),      
        // ]);
        // User::create([
        //     'name' => 'Sergio Admin (asd)',
        //     'email' => 'admin@admin.com',
        //     'password' => Hash::make('asd'),   
        //     'is_admin' => true,   
        // ]);
        //TODO: Descomentar seeders
        // $this->call(CategorySeeder::class);
        // $this->call(SaleTypesTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);
        // $this->call(ProductWeightsTableSeeder::class);  
        // $this->call(OrderStatusSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
