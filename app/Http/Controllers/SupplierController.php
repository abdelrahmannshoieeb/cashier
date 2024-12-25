<?php

namespace App\Http\Controllers;

use App\Models\CustomerBonnd;
use App\Models\settings;
use App\Models\Supplier;
use App\Models\SupplierBond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function getSuppliers()
    {
        $suppliers  = Supplier::all();

        if ($suppliers->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No customers found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $suppliers

        ], 200);
    }

    public function addSupplier(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|max:11',
            'notes' => 'nullable|string',
            'balance' => 'required|numeric|regex:/^\d+(\.\d{1})?$/',
        ]);

        // Create the customer
        $supplier = new Supplier();
        $supplier->name = $validatedData['name'];
        $supplier->address = $validatedData['address'] ?? null;
        $supplier->phone = $validatedData['phone'];
        $supplier->notes = $validatedData['notes'] ?? null;
        $supplier->balance = $validatedData['balance'];
        $supplier->save();

        // Return a JSON response
        return response()->json([
            'success' => true,
            'data' => $supplier
        ], 200);
    }






    public function addSupplierBond(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|numeric|regex:/^\d+(\.\d{1})?$/',
            'notes' => 'nullable|string',
            'method' => 'required|string|in:cash,credit,cheque',
            'type' => 'required|string|in:add,subtract',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $settings = Settings::first();
        $type = $request->type == 1 ? 'add' : 'subtract';

        $supplierTransaction = SupplierBond::create([
            'type' => $type,
            'value' => $request->value,
            'notes' => $request->note,
            'method' => $request->method,
            'supplier_id' => $request->supplier_id
        ]);

        if ($supplierTransaction) {
            $supplier = $supplierTransaction->supplier;

            // dd($customer);
            // Update customer's balance
            // dd([
            //     $settings->subtract_suppliers_fund_to_box,

            // ]);
            if ($request->type == 'add' && $settings->subtract_Suppliers_fund_from_box) {
                $supplier->balance += $request->value;
                $settings->update([
                    'box_value' => $settings->box_value - $request->value,
                ]);
                $supplier->save();
            }

            if ($request->type == 'subtract' && $settings->subtract_Suppliers_fund_from_box) {
                $supplier->balance -= $request->value;
                $settings->update([
                    'box_value' => $settings->box_value + $request->value,
                ]);
                $supplier->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => $type == 'add' ? 'Amount added successfully' : 'Amount subtracted successfully',
            'data' => $supplierTransaction,

        ], 200);
    }



}
