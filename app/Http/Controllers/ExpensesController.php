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
        $settings = settings::first();
        if (auth()->user()->add_expense == 0) {
            return response()->json([
                'success' => false,
                'message' => 'User not authorized'
            ], 403);
        } else {


            if ($request->type == 'add') {
                // dd($settings->subtract_Expenses_from_box);
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'value' => 'required|numeric|min:0',
                    'method' => 'required|string|in:box,credit',
                    'type' => 'required|string|in:add,subtract',
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
                    'method' => $request->method,
                    'type' => $request->type,
                    'user_id' => auth()->user()->id
                ]);
                if ($settings->subtract_Expenses_from_box == 1) {
                    $settings->update([
                        'box_value' => $settings->box_value + $request->value,
                    ]);
                }
            }

            if ($request->type == 'subtract' ) {

                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'value' => 'required|numeric|min:0',
                    'method' => 'required|string|in:box,credit',
                    'type' => 'required|string|in:add,subtract',
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
                    'method' => $request->method,
                    'type' => $request->type,
                    'user_id' => auth()->user()->id
                ]);
                if ($settings->subtract_Expenses_from_box == 1 && $settings->box_value >= $request->value) {
                    $settings->update([
                        'box_value' => $settings->box_value - $request->value,
                        
                    ]);
                    return response()->json([
                        'expense operation' => 'done',
                        'subtracting from box' => 'done',
                        'data' => $expense
                    ], 200);
                } else {
                    return response()->json([
                        'expense operation' => 'done',
                        'subtracting from box' => 'false',
                        'data' => $expense
                    ], 200);
                }
            }
           
            return response()->json([
                'success' => true,
                'data' => $expense
            ] ,200);
        }
    }
}
