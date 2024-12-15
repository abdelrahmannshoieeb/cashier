<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'role' => 'admin',
                'password' => Hash::make('admin'),
                'is_active' => 1,
                'phone' => '1234567890',
                'box_access' => true,
                'edit_invoices_access' => true,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User1',
                'role' => 'user',
                'password' => Hash::make('user123'),
                'is_active' => 1,
                'phone' => '0987654321',
                'box_access' => false,
                'edit_invoices_access' => false,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User2',
                'role' => 'user',
                'password' => Hash::make('password123'),
                'is_active' => 0,
                'phone' => null,
                'box_access' => false,
                'edit_invoices_access' => true,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
