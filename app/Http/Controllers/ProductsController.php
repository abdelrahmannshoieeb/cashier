<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function addProduct(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price1' => 'required|integer',
            'price2' => 'nullable|integer',
            'price3' => 'nullable|integer',
            'buying_price' => 'nullable|integer',
            'itemStock' => 'nullable|integer',
            'PacketStock' => 'nullable|integer',
            'items_in_packet' => 'nullable|integer',
            'stockAlert' => 'nullable|integer',
            'endDate' => 'nullable|date',
            'isActive' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Create product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price1' => $request->price1,
            'price2' => $request->price2,
            'price3' => $request->price3,
            'buying price' => $request->{'buying price'},
            'itemStock' => $request->itemStock,
            'PacketStock' => $request->PacketStock,
            'items_in_packet' => $request->items_in_packet,
            'stockAlert' => $request->stockAlert,
            'endDate' => $request->endDate,
            'isActive' => $request->isActive ?? 1, // Default to active
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

    // GET: Retrieve all products
    public function getProducts()
    {
        $products = Product::with('category', 'user')->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }
}
