<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Sample customer data
        Customer::create([
            'name' => 'John Doe',
            'address' => '123 Main St',
            'phone1' => 1234567890,
            'phone2' => 9876543210,
            'notes' => 'Preferred customer',
            'pocket_number' => 0101010101,
            'balance' => 1000,
            'sell_price' => 500,
            'credit_limit' => 2000,
            'credit_limit_days' => 30,
        ]);

        Customer::create([
            'name' => 'Jane Smith',
            'address' => '456 Elm St',
            'phone1' => 01102102007,
            'phone2' => 5557654321,
            'notes' => 'Has pending invoices',
            'pocket_number' => 1010101010,
            'balance' => 500,
            'sell_price' => 400,
            'credit_limit' => 1500,
            'credit_limit_days' => 45,
        ]);

        Customer::create([
            'name' => 'Alice Brown',
            'address' => '789 Oak St',
            'phone1' => 010203040506,
            'phone2' => 9876543210,
            'notes' => 'First-time buyer',
            'pocket_number' => 0101010101,
            'balance' => 750,
            'sell_price' => 600,
            'credit_limit' => 1000,
            'credit_limit_days' => 60,
        ]);
    }
}
