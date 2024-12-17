<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/categories', [CategoriesController::class, 'getCategories']);
    Route::post('/categories', [CategoriesController::class, 'addCategory']);
    Route::post('/products', [ProductsController::class, 'addProduct']);
Route::get('/products', [ProductsController::class, 'getProducts']);
});

Route::post('/login', [AuthController::class, 'login']);