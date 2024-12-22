<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getCustomers(){
        $customers  = Customer::all();

        if ($customers->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No customers found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $customers

        ], 200);
    }


    public function addCustomer(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone1' => 'required|string|max:11',
            'phone2' => 'nullable|string|max:11',
            'notes' => 'nullable|string',
            'pocket_number' => 'required|string|max:11',
            'balance' => 'required|numeric|regex:/^\d+(\.\d{1})?$/',
            'sell_price' => 'required|integer',
            'credit_limit' => 'nullable|integer|min:0',
            'credit_limit_days' => 'nullable|integer|min:0',
        ]);
    
        // Create the customer
        $customer = new Customer();
        $customer->name = $validatedData['name'];
        $customer->address = $validatedData['address'] ?? null;
        $customer->phone1 = $validatedData['phone1'];
        $customer->phone2 = $validatedData['phone2'] ?? null;
        $customer->notes = $validatedData['notes'] ?? null;
        $customer->pocket_number = $validatedData['pocket_number'];
        $customer->balance = $validatedData['balance'];
        $customer->sell_price = $validatedData['sell_price'];
        $customer->credit_limit = $validatedData['credit_limit'] ?? null;
        $customer->credit_limit_days = $validatedData['credit_limit_days'] ?? null;
        $customer->save();
    
        // Return a JSON response
        return response()->json([
            'success' => true,
            'data' => $customer
        ], 200);
    }
    
}
