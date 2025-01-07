<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Invoice_item;
use App\Models\Product;
use App\Models\settings;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoicController extends Controller
{
    public function searchProduct(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->search . '%')->with('stock')->get();
    
        $transformedProducts = $products->map(function ($product) {
            $productData = $product->toArray(); // Get product data as an array
            $itemStock = $product->itemStock;
    
            // If itemStock is not 0, return the product data without stock types
            if ($itemStock > 0) {
                unset($productData['stock']); // Remove the stock relation
                return $productData;
            }
    
            // ItemStock is 0, find the first stock type with quantity > 0
            $stockTypes = ['1', '2', '3', '4']; // Define stock types in priority order
            $stockTypeData = null; // Initialize as null
    
            foreach ($stockTypes as $type) {
                $stock = $product->stock->where('type', $type)->first();
                if ($stock && $stock->quantity > 0) {
                    $stockTypeData = [
                        'type' => $type,
                        'price' => $stock->price,
                        'quantity' => $stock->quantity,
                    ];
                    break;
                }
            }
    
            // If no valid stock type is found, mark as "Out of Stock" and limit details
            if (!$stockTypeData) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'status' => 'Out of Stock'
                ];
            }
    
            // Add the stockType data if found
            unset($productData['stock']); // Remove the stock relation
            $productData['stockType'] = $stockTypeData;
            return $productData;
        });
    
        return response()->json([
            'success' => true,
            'data' => $transformedProducts,
        ], 200);
    }
    
    
    
    
    


    public function searchCustomer(Request $request){
        $customer = Customer::where('name', 'like', '%' . $request->search . '%')
       
        ->get();
    
        return response()->json([
            'success' => true,
            'data' => $customer
        ], 200);
    }








    public function saveInvoice(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.calculated_price' => 'required',
            'payMethod' => 'required|string',
            'payedAmount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'customerType' => 'required|string|in:attached,unattached',
            'customerName' => 'required_if:customerType,unattached|string',
            'selectedCustomerId' => 'required_if:customerType,attached|exists:customers,id',
            'notes' => 'nullable|string',
        ]);
    
        // Handle validation errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        // Extract data from the request
        $items = $request->input('items');
        $payMethod = $request->input('payMethod');
        $payedAmount = $request->input('payedAmount');
        $discount = $request->input('discount', 0);
        $customerType = $request->input('customerType');
        $customerName = $customerType === 'unattached' ? $request->input('customerName') : null;
        $selectedCustomerId = $customerType === 'attached' ? $request->input('selectedCustomerId') : null;
        $notes = $request->input('notes');
        $user_id = $request->input('user_id');
    
        // Calculate total
        $total = collect($items)->sum(function ($item) use ($discount) {
            return $item['quantity'] * $item['calculated_price'] - $discount;
        });
    
        // Handle customer balance for attached customers
        if ($customerType === 'attached') {
            $customer = Customer::find($selectedCustomerId);
            $customer->balance = $customer->balance - $total + $payedAmount + $discount;
            $customer->save();
        }
    
        // Determine status
        $status = 'unpaid';
        $still = $total;
    
        if ($payedAmount < $total) {
            $status = 'partiallyPaid';
            $still = $total - $payedAmount;
        } elseif ($payedAmount == $total) {
            $status = 'paid';
        }
    
        // Create the invoice
        $invoice = Invoice::create([
            'total' => $total,
            'payMethod' => $payMethod,
            'payedAmount' => $payedAmount,
            'notes' => $notes,
            'discount' => $discount,
            'status' => $status,
            'customerType' => $customerType,
            'customerName' => $customerType === 'unattached' ? $customerName : null, // Save only for unattached
            'customer_id' => $customerType === 'attached' ? $selectedCustomerId : null, // Save only for attached
            'still' => $still,
            'user_id' => auth()->user()->id,
        ]);
    
        // Save items logic remains unchanged
        $itemDetails = []; // Array to store detailed item info

        foreach ($items as $item) {
            $product = Product::find($item['product_id']); // Retrieve product details
        
            if ($product) {
                // Update stock logic remains unchanged
                $remainingQty = $item['quantity'];
        
                if ($product->itemStock >= $remainingQty) {
                    $product->itemStock -= $remainingQty;
                    $product->save();
                    $remainingQty = 0;
                } else {
                    $remainingQty -= $product->itemStock;
                    $product->itemStock = 0;
                    $product->save();
                }
        
                if ($remainingQty > 0) {
                    $stocks = Stock::where('product_id', $item['product_id'])->orderBy('type')->get();
                    foreach ($stocks as $stock) {
                        if ($stock->quantity >= $remainingQty) {
                            $stock->quantity -= $remainingQty;
                            $stock->save();
                            $remainingQty = 0;
                            break;
                        } else {
                            $remainingQty -= $stock->quantity;
                            $stock->quantity = 0;
                            $stock->save();
                        }
                    }
                }
        
                if ($remainingQty > 0) {
                    return response()->json([
                        'success' => false,
                        'message' => "Insufficient stock for product ID: {$item['product_id']}",
                    ], 400);
                }
        
                // Save item details for the response
                $itemDetails[] = [
                    'product_id' => $item['product_id'],
                    'product_name' => $product->name,
                    'quantity' => $item['quantity'],
                    'calculated_price' => $item['calculated_price'],
                ];
        
                // Save the invoice item
                Invoice_item::create([
                    'qty' => $item['quantity'],
                    'sellPrice' => $item['calculated_price'],
                    'product_id' => $item['product_id'],
                    'invoice_id' => $invoice->id,
                ]);
            }
        }
        
        // Add seller's funds to box if enabled
        $settings = settings::first();
        if ($settings->adding_sellers_fund_to_box) {
            $settings->update([
                'box_value' => $settings->box_value + $payedAmount,
            ]);
        }
        

        // Response with item details and product names
        return response()->json([
            'success' => true,
            'message' => 'Invoice created successfully.',
            'invoice' => $invoice,
            'items' => $itemDetails, // Include detailed items with product names
            'total' => $total,
            'employee_name' => auth()->user()->name,
            'employee_shop' => auth()->user()->shop->name,
            'customer_name' => $customerType === 'unattached' ? $customerName : $customer->name,
        ]);
    }


    public function getInvoices()
    {
        $invoices = Invoice::where('user_id', auth()->user()->id)->get();
    
        $data = $invoices->map(function ($invoice) {
            return [
                'id' => $invoice->id,
                'total' => $invoice->total,
                'payedAmount' => $invoice->payedAmount,
                'discount' => $invoice->discount,
                'status' => $invoice->status,
                'customer_name' => $invoice->customerType === 'unattached' 
                    ? $invoice->customerName 
                    : $invoice->customer->name,
                'employee_name' => auth()->user()->name,
                'employee_shop' => auth()->user()->shop->name,
                'day' => $invoice->created_at->format('Y-m-d'),
                'time' => $invoice->created_at->addHours(2)->format('H:i'),
                'items' => $invoice->items->map(function ($item) {
                    return [
                        'qty' => $item->qty,
                        'sellPrice*qty' => $item->qty * $item->sellPrice,
                        'sellPrice' => $item->sellPrice,
                        'product_name' => $item->product->name,
                    ];
                }),
            ];
        });
    
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }
    
    


}
