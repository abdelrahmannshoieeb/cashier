<?php

namespace App\Http\Controllers;

use App\Livewire\Expenses\Expenses;
use App\Models\Expense;

use App\Models\settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpensesController extends Controller
{
    public function addExpense(Request $request)
    {
        $settings = Settings::first();
    
        if (auth()->user()->add_expense == 0) {
            return response()->json([
                'success' => false,
                'message' => 'User not authorized'
            ], 403);
        }
    
        // Map Arabic terms to English equivalents
        $methodMapping = [
            'صندوق' => 'box',
            'ائتمان' => 'credit',
        ];
    
        $typeMapping = [
            'إضافة' => 'add',
            'سحب' => 'subtract',
        ];
    
        $method = $methodMapping[$request->method] ?? $request->method;
        $type = $typeMapping[$request->type] ?? $request->type;
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'value' => 'required|numeric|min:0',
            'method' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($methodMapping) {
                    if (!in_array($value, array_keys($methodMapping))) {
                        $fail('طريقة الدفع يجب أن تكون واحدة من: صندوق، ائتمان');
                    }
                },
            ],
            'type' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($typeMapping) {
                    if (!in_array($value, array_keys($typeMapping))) {
                        $fail('نوع العملية يجب أن تكون واحدة من: إضافة، سحب');
                    }
                },
            ],
        ]);
    
        // Check for validation errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        $expense = Expense::create([
            'name' => $request->name,
            'value' => $request->value,
            'method' => $method,
            'type' => $type,
            'user_id' => auth()->user()->id,
        ]);
    
        if ($type === 'add') {
            if ($settings->subtract_Expenses_from_box == 1) {
                $settings->update([
                    'box_value' => $settings->box_value + $request->value,
                ]);
            }
        }
    
        if ($type === 'subtract') {
            if ($settings->subtract_Expenses_from_box == 1 && $settings->box_value >= $request->value) {
                $settings->update([
                    'box_value' => $settings->box_value - $request->value,
                ]);
    
                return response()->json([
                    'expense_operation' => 'done',
                    'subtracting_from_box' => 'done',
                    'data' => $expense
                ], 200);
            } else {
                return response()->json([
                    'expense_operation' => 'done',
                    'subtracting_from_box' => 'false',
                    'data' => $expense
                ], 200);
            }
        }
    
        return response()->json([
            'success' => true,
            'data' => $expense
        ], 200);
    }
    
}
