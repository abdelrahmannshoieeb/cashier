<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Invoice_item;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoicController extends Controller
{
    public function searchProduct(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->search . '%')->with('stock')->get();
    
        $transformedProducts = $products->map(function ($product) {
            // Filter stocks with quantity not equal to 1
            $filteredStocks = $product->stock->filter(function ($stock) {
                return $stock->quantity != 0;
            });
    
            // Create separate fields for each stock type if it exists
            $stockData = [];
            foreach ($filteredStocks as $stock) {
                $stockData['stockType_' . $stock->type] = [
                    'price' => $stock->price,
                    'quantity' => $stock->quantity,
                ];
            }
    
            // Exclude the 'stock' relation and return the transformed data
            $productData = $product->toArray();
            unset($productData['stock']); // Remove the stock relation
    
            return array_merge($productData, $stockData);
        });
    
        return response()->json([
            'success' => true,
            'data' => $transformedProducts
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
            'product_id.*.id' => 'required|exists:products,id',
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
        $customerName = $request->input('customerName');
        $selectedCustomerId = $request->input('selectedCustomerId');
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
            'customerName' => $customerName,
            'customer_id' => $selectedCustomerId,
            'still' => $still,
            'user_id' => auth()->user()->id
        ]);

        foreach ($items as $item) {
            // Save Invoice Item
            Invoice_item::create([
                'qty' => $item['quantity'],
                'sellPrice' => $item['calculated_price'],
                'product_id' => $item['product_id'],
                'invoice_id' => $invoice->id,
            ]);

            $remainingQty = $item['quantity']; // The quantity to be subtracted
            $product = Product::find($item['product_id']);

            if ($product) {
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
                    $stocks = Stock::where('product_id', $item['id'])->orderBy('type')->get();

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
                        'message' => "Insufficient stock for product ID: {$item['id']}",
                    ], 400);
                }
            }
        }

        $total = collect($items)->sum(function ($item) use ($request) {
            $discount = $request->input('discount', 0); 
            return ($item['quantity'] * $item['calculated_price']) - $discount;
        });
        
        return response()->json([
            'success' => true,
            'message' => 'Invoice created successfully.',
            'invoice' => $invoice,
            'items' => $items,
            'total' => $total
        ]);
    }



}
