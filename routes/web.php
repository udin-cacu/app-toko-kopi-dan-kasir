<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\{
    DashboardController, CategoryController, ProductController, CustomerController, OrderController, ReportController, ShopController, StaffOrderController
};

// Route::get('/', function(){ return redirect()->route('dashboard'); });

Route::get('/', [ShopController::class,'index'])->name('shop.index');

Route::get('/menu', [ShopController::class,'menu'])->name('shop.menu');
Route::get('/menu2', [ShopController::class,'menu2'])->name('shop.menu2');
Route::get('/menu/categories', [ShopController::class,'categories'])->name('shop.categories');

// Shop (public)
Route::get('/cart', [ShopController::class,'cart'])->name('shop.cart');
Route::get('/cart2', [ShopController::class,'cart2'])->name('shop.cart2');
Route::post('/cart/add', [ShopController::class,'addToCart'])->name('shop.add');
Route::post('/cart/update', [ShopController::class,'updateCart'])->name('shop.update');
Route::post('/cart/remove', [ShopController::class,'removeFromCart'])->name('shop.remove');
Route::get('/checkout', [ShopController::class,'checkout'])->name('shop.checkout');
Route::get('/checkout2', [ShopController::class,'checkout2'])->name('shop.checkout2');
Route::post('/checkout', [ShopController::class,'processCheckout'])->name('shop.process');
Route::get('/success', [ShopController::class,'success'])->name('shop.success');
Route::get('/success2', [ShopController::class,'success2'])->name('shop.success2');

Route::get('/about', [ShopController::class,'about'])->name('shop.about');
Route::get('/services', [ShopController::class,'services'])->name('shop.services');
/*Route::view('/about', 'shop.about')->name('about');
Route::view('/services', 'shop.services')->name('services');*/

// routes/web.php
Route::prefix('staff/orders')->group(function(){
    Route::post('{id}/confirm-cash', [ShopController::class,'confirmCash']);
});
Route::post('/payment/snap-token', [App\Http\Controllers\ShopController::class, 'createSnapToken'])
->name('payment.snap');


Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::middleware('role:admin,kasir')->group(function(){
        // Categories
        Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
        Route::post('/categories/store',[CategoryController::class,'store'])->name('categories.store');
        Route::post('/categories/edit',[CategoryController::class,'edit'])->name('categories.edit');
        Route::post('/categories/update',[CategoryController::class,'update'])->name('categories.update');
        Route::post('/categories/delete',[CategoryController::class,'destroy'])->name('categories.delete');

        // Products
        Route::get('/products',[ProductController::class,'index'])->name('products.index');
        Route::post('/products/store',[ProductController::class,'store'])->name('products.store');
        Route::post('/products/edit',[ProductController::class,'edit'])->name('products.edit');
        Route::post('/products/update',[ProductController::class,'update'])->name('products.update');
        Route::post('/products/delete',[ProductController::class,'destroy'])->name('products.delete');
        Route::post('/products/upload',[ProductController::class,'upload'])->name('products.upload');

        // Customers
        Route::get('/customers',[CustomerController::class,'index'])->name('customers.index');
        Route::post('/customers/store',[CustomerController::class,'store'])->name('customers.store');
        Route::post('/customers/edit',[CustomerController::class,'edit'])->name('customers.edit');
        Route::post('/customers/update',[CustomerController::class,'update'])->name('customers.update');
        Route::post('/customers/delete',[CustomerController::class,'destroy'])->name('customers.delete');

        // POS
        Route::get('/pos',[OrderController::class,'pos'])->name('pos');
        Route::get('/pos/search',[OrderController::class,'searchProducts'])->name('pos.search');
        Route::post('/pos/store',[OrderController::class,'store'])->name('pos.store');
        Route::get('/orders/datatable',[OrderController::class,'datatable'])->name('orders.datatable');
        Route::get('/orders/{id}',[OrderController::class,'show'])->name('orders.show');
        Route::post('/orders/{id}/confirm',[OrderController::class,'confirm'])->name('orders.confirm');
        Route::post('/pos/paymen',[OrderController::class,'paymen'])->name('pos.paymen');

        // Staff web orders
        Route::get('/staff/orders',[StaffOrderController::class,'index'])->name('staff.orders.index');
        Route::post('/staff/orders/{id}/confirm',[StaffOrderController::class,'confirm'])->name('staff.orders.confirm');

    });
        // Reports
    Route::get('/reports/sales',[ReportController::class,'sales'])->name('reports.sales');
});
