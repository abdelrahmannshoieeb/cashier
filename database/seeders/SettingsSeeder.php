<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'box_value' => '200',
                'adding_customers_fund_to_box' => true,
                'adding_sellers_fund_to_box' => true,
                'subtract_Suppliers_fund_from_box' => true,
                'subtract_Procurement_fund_from_box' => true,
                'subtract_Expenses_from_box' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
