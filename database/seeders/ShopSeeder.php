<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shops')->insert([
            [
                'name' => 'shop1',
                
            ],
            [
                'name' => 'shop2',
             
            ],
            [
                'name' => 'shop3',
             
            ],
        ]);
    }
}
