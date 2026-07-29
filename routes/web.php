<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SaleReceiptController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\PurchaseReceiptController;
use App\Http\Controllers\Admin\SupplierController;

/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/', [LoginController::class, 'index'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.check');

Route::get('/logout', [LoginController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Category
    |--------------------------------------------------------------------------
    */

    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::get('/categories/create', [CategoryController::class, 'create'])
        ->name('categories.create');

    Route::post('/categories/store', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])
        ->name('categories.edit');

    Route::put('/categories/{id}', [CategoryController::class, 'update'])
        ->name('categories.update');

    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');


    /*
    |--------------------------------------------------------------------------
    | Supplier
    |--------------------------------------------------------------------------
    */

    Route::get('/suppliers', [SupplierController::class, 'index'])
        ->name('suppliers.index');

    Route::get('/suppliers/create', [SupplierController::class, 'create'])
        ->name('suppliers.create');

    Route::post('/suppliers/store', [SupplierController::class, 'store'])
        ->name('suppliers.store');

    Route::get('/suppliers/{id}/edit', [SupplierController::class, 'edit'])
        ->name('suppliers.edit');

    Route::put('/suppliers/{id}', [SupplierController::class, 'update'])
        ->name('suppliers.update');

    Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy'])
        ->name('suppliers.destroy');


    /*
    |--------------------------------------------------------------------------
    | Product
    |--------------------------------------------------------------------------
    */


    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    Route::post('/products/store', [ProductController::class, 'store'])
        ->name('products.store');

    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    Route::put('/products/{id}', [ProductController::class, 'update'])
        ->name('products.update');

    Route::delete('/products/{id}', [ProductController::class, 'destroy'])
        ->name('products.destroy');

    /*
    |--------------------------------------------------------------------------
    | Pruchase
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/purchases',
        [PurchaseController::class, 'index']
    )
        ->name('purchases.index');

    Route::get(
        '/purchases/create',
        [PurchaseController::class, 'create']
    )
        ->name('purchases.create');

    Route::post(
        '/purchases/store',
        [PurchaseController::class, 'store']
    )
        ->name('purchases.store');

    Route::get(
        '/purchases/{id}/edit',
        [PurchaseController::class, 'edit']
    )
        ->name('purchases.edit');

    Route::put(
        '/purchases/{id}',
        [PurchaseController::class, 'update']
    )
        ->name('purchases.update');

    Route::delete(
        '/purchases/{id}',
        [PurchaseController::class, 'destroy']
    )
        ->name('purchases.destroy');

    /*
    |--------------------------------------------------------------------------
    | Pruchase invoice PDF
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/purchase-invoice/{id}',
        [PurchaseReceiptController::class, 'download']
    )
        ->name('purchase.invoice');


    /*
    |--------------------------------------------------------------------------
    | Sales
    |--------------------------------------------------------------------------
    */
    Route::get(
        '/sales',
        [SaleController::class, 'index']
    )
        ->name('sales.index');

    Route::get(
        '/sales/create',
        [SaleController::class, 'create']
    )
        ->name('sales.create');

    Route::post(
        '/sales/store',
        [SaleController::class, 'store']
    )
        ->name('sales.store');

    Route::delete(
        '/sales/{id}',
        [SaleController::class, 'destroy']
    )
        ->name('sales.destroy');
    /*
    |--------------------------------------------------------------------------
    | Sales invoice PDF
    |--------------------------------------------------------------------------
    */
    Route::get(
        '/sales/invoice/{id}',
        [SaleReceiptController::class, 'download']
    )
        ->name('sales.invoice');


});