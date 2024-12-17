<?php

use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// make midllware for auth and make it group
    
Route::middleware(['auth'])->group(function () {
    Route::view('/', 'index')->name('index');
    Route::view('/addCategory', 'category.addCategory')->name('addCategory');
    Route::view('/addProduct', 'product.addProduct')->name('addProduct');
    Route::view('/products', 'product.products')->name('products');
    Route::view('/addWorker', 'workers.addWorker')->name('addWorker');
    Route::view('/workers', 'workers.workers')->name('workers');
    Route::view('/boxControl', 'box.boxControl')->name('boxControl');
    Route::view('/boxoperations', 'box.boxoperations')->name('boxoperations');
    
    Route::view('/addCustomersBalance', 'customers.addCustomersBalance')->name('addCustomersBalance');
    Route::view('/addCustomer', 'customers.addCustomer')->name('addCustomer');
    Route::view('/customers', 'customers.customers')->name('customers');
    Route::view('/customerBonnds', 'customers.customersBonds')->name('customerBonnds');

    Route::view('/addSupplierBalance', 'suppliers.addSupplierBalance')->name('addSupplierBalance');
    Route::view('/addSupplier', 'suppliers.addSupplier')->name('addSupplier');
    Route::view('/suppliers', 'suppliers.suppliers')->name('suppliers');
    Route::view('/supplierBonnds', 'suppliers.supplierBonnds')->name('supplierBonnds');
});

Route::view('/login', 'Auth.login') ->name ('login');
