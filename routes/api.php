<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\InvoicController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SupplierController;
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
 
    Route::get ('/products', [ProductsController::class, 'getProducts']);
    Route::get ('/productByCategory/{id}', [ProductsController::class, 'getProductByCategory']);
    Route::post('/product', [ProductsController::class, 'addProduct']);
    Route::put('/product/{id}', [ProductsController::class, 'editProduct']);

    Route::post('/expense', [ExpensesController::class, 'addExpense']);

    
    Route::get('/customers', [CustomerController::class, 'getCustomers']);
    Route::post('/addCustomer', [CustomerController::class, 'addCustomer']);
    Route::post('/addCustomerBond', [CustomerController::class, 'addCustomerBond']);
    
    Route::get('/suppliers', [SupplierController::class, 'getSuppliers']);
    Route::post('/addSupplier', [SupplierController::class, 'addSupplier']);
    Route::post('/addSupplierBond', [SupplierController::class, 'addSupplierBond']);

    Route::get('searchProduct', [InvoicController::class, 'searchProduct']);
    Route::get('searchCustomer', [InvoicController::class, 'searchCustomer']);
    Route::post('/save-invoice', [InvoicController::class, 'saveInvoice']);
    Route::get('/getInvoices', [InvoicController::class, 'getInvoices']);

});

Route::post('/login', [AuthController::class, 'login']);