<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
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
            'price1' => 'required|numeric|regex:/^\d+(\.\d{1})?$/',
            'price2' => 'nullable|numeric|regex:/^\d+(\.\d{1})?$/',
            'price3' => 'nullable|numeric|regex:/^\d+(\.\d{1})?$/',
            'buying_price' => 'nullable|numeric|regex:/^\d+(\.\d{1})?$/',

            'itemStock' => 'nullable|integer',
            'PacketStock' => 'nullable|integer',
            'items_in_packet' => 'nullable|integer',
            'stockAlert' => 'nullable|integer',
            'endDate' => 'nullable|date',
            'isActive' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
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

    public function editProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Check if user is authorized to edit the product
        if (auth()->user()->edit_product == 0) {
            return response()->json([
                'success' => false,
                'message' => 'User not authorized'
            ], 403);
        }

        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price1' => 'required|numeric|min:0',
            'price2' => 'nullable|numeric|min:0',
            'price3' => 'nullable|numeric|min:0',
            'buying_price' => 'nullable|numeric|min:0',
            'itemStock' => 'nullable|integer|min:0',
            'PacketStock' => 'nullable|integer|min:0',
            'items_in_packet' => 'nullable|integer|min:0',
            'stockAlert' => 'nullable|integer|min:0',
            'endDate' => 'nullable|date',
            'isActive' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Update product fields
        $product->update($request->only([
            'name',
            'description',
            'price1',
            'price2',
            'price3',
            'buying_price',
            'itemStock',
            'PacketStock',
            'items_in_packet',
            'stockAlert',
            'endDate',
            'isActive',
            'category_id'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }
    public function getProductByCategory(Request $request)
    {
        $products = Product::where('category_id', $request->id)->get();
        if ($products->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No products found for this category'
            ], 404);
        } else {
            return response()->json([
                'success' => true,
                'data' => $products
            ]);
        }
    }
}
