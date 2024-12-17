<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerBonnd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerBondSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $customers = Customer::all();

        // Create bonds for each customer
        foreach ($customers as $customer) {
            CustomerBonnd::create([
                'type' => 'add',
                'value' => 500,
                'notes' => 'Initial deposit',
                'method' => 'cash',
                'customer_id' => $customer->id,
            ]);

            CustomerBonnd::create([
                'type' => 'subtract',
                'value' => 300,
                'notes' => 'Payment received',
                'method' => 'credit',
                'customer_id' => $customer->id,
            ]);
        }
    }
}
