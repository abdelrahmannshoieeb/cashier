<?php

namespace App\Http\Controllers;

use App\Models\CustomerBonnd;
use App\Models\settings;
use App\Models\Supplier;
use App\Models\SupplierBond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'note' => 'nullable|string',
            'method' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $validMethods = ['نقد', 'ائتمان', 'شيك']; // Arabic equivalents of cash, credit, cheque
                    if (!in_array($value, $validMethods)) {
                        $fail('طريقة الدفع يجب أن تكون واحدة من: نقد، ائتمان، شيك');
                    }
                },
            ],
            'type' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $validTypes = ['اضافة', 'سحب']; // Arabic equivalents of add, subtract
                    if (!in_array($value, $validTypes)) {
                        $fail('نوع العملية يجب أن يكون واحدة من: إضافة، سحب');
                    }
                },
            ],
            'supplier_id' => 'required|exists:suppliers,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        $settings = Settings::first();
    
        // Map Arabic terms to English equivalents
        $methodMapping = [
            'نقد' => 'cash',
            'ائتمان' => 'credit',
            'شيك' => 'cheque',
        ];
    
        $typeMapping = [
            'اضافة' => 'add',
            'سحب' => 'subtract',
        ];
    
        $method = $methodMapping[$request->method] ?? $request->method;
        $type = $typeMapping[$request->type] ?? $request->type;
    
        $supplierTransaction = SupplierBond::create([
            'type' => $type,
            'value' => $request->value,
            'notes' => $request->note,
            'method' => $method,
            'supplier_id' => $request->supplier_id,
        ]);

        $supplier_bond = [
            'id' => $supplierTransaction->id,
            'type' => $request->type,
            'value' => $supplierTransaction->value,
            'notes' => $supplierTransaction->notes,
            'method' => $request->method,
            'customerName' => $supplierTransaction->customer->name,
            'userName' => Auth::user()->name,
            'shopName' => Auth::user()->shop->name,
            'day' => $supplierTransaction->created_at->format('Y-m-d'),
            'time' => $supplierTransaction->created_at->addHours(2)->format('H:i'),
        ];
    
        if ($supplierTransaction) {
            $supplier = $supplierTransaction->supplier;
    
            // Update supplier's balance and box value
            if ($type === 'add' && $settings->subtract_Suppliers_fund_from_box) {
                $supplier->balance += $request->value;
                $settings->update([
                    'box_value' => $settings->box_value - $request->value,
                ]);
                $supplier->save();
            }
    
            if ($type === 'subtract' && $settings->subtract_Suppliers_fund_from_box) {
                $supplier->balance -= $request->value;
                $settings->update([
                    'box_value' => $settings->box_value + $request->value,
                ]);
                $supplier->save();
            }
        }
    
        return response()->json([
            'success' => true,
            'message' => $type === 'add' ? 'Amount added successfully' : 'Amount subtracted successfully',
            'data' => $supplier_bond,
        ], 200);
    }
    
    



}
