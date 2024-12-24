<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerBonnd;
use App\Models\Expense;
use App\Models\settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function getCustomers()
    {
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


    public function addCustomerBond(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|numeric|regex:/^\d+(\.\d{1})?$/',
            'notes' => 'nullable|string',
            'method' => 'required|string|in:cash,credit,cheque',
            'type' => 'required|string|in:add,subtract',
            'customer_id' => 'required|exists:customers,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $settings = Settings::first();
        $type = $request->type == 1 ? 'add' : 'subtract';

        $customerTransaction = CustomerBonnd::create([
            'type' => $type,
            'value' => $request->value,
            'notes' => $request->note,
            'method' => $request->method,
            'customer_id' => $request->customer_id
        ]);

        if ($customerTransaction) {
            $customer = $customerTransaction->customer;

            // dd($customer);
            // Update customer's balance
            if ($request->type == 'add' && $settings->adding_customers_fund_to_box) {
                $customer->balance += $request->value;
                $settings->update([
                    'box_value' => $settings->box_value - $request->value,
                ]);
                $customer->save();
            }

            if ($request->type == 'subtract' && $settings->adding_customers_fund_to_box) {
                $customer->balance -= $request->value;
                $settings->update([
                    'box_value' => $settings->box_value + $request->value,
                ]);
                $customer->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => $type == 'add' ? 'Amount added successfully' : 'Amount subtracted successfully',
            'data' => $customerTransaction,

        ], 200);
    }
}
