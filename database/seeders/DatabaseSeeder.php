<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use Database\Seeders\SettingsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call(ShopSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CustomerBondSeeder::class);
    }
}
