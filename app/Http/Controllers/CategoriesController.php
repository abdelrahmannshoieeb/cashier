<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function addCategory(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new category
        $category = new Category();
        $category->name = $request->name; // Save the Arabic name
        $category->user_id = $request->user_id; // You can set a default user_id or get from the authenticated user
        $category->save();

        return response()->json([
            'success' => true,
            'data' => $category,
        ], 201);

    }

    // Endpoint to get all categories
    public function getCategories()
    {
        $categories = Category::all();

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }
}
