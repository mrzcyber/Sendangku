<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RestaurantMenuController;
use App\Http\Controllers\Admin\RestaurantOrderController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServicePackageController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\TicketTypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\OrderController as PublicOrderController;
use App\Http\Controllers\Public\RestaurantMenuController as PublicRestaurantMenuController;
use App\Http\Controllers\Public\RestaurantOrderController as PublicRestaurantOrderController;
use App\Http\Controllers\Public\ServiceController as PublicServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/layanan', function () {
    return view('front.service');
});
Route::get('/layanan/berkuda', function () {
    return view('front.detail');
});
Route::get('/checkout/ticket', function () {
    return view('front.checkout-ticket');
});
Route::get('/checkout/ticket/succes', function () {
    return view('front.ticket-succes');
});


Route::post('/login', [UserController::class, 'authenticate'])->name('login.auth');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/login', function () {
    return view('login');
})->name('login');


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::middleware('role:admin')->group(function(){
    Route::resource('/user', UserController::class);
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/blog', BlogController::class);
    Route::resource('/service', ServiceController::class);
    Route::resource('/service-package',ServicePackageController::class);

    });

    Route::middleware('role:admin,kasir')->group(function(){
    Route::resource('/restaurant-menu',RestaurantMenuController::class);
    Route::resource('/restaurant-order',RestaurantOrderController::class);
    Route::resource('/table',TableController::class);
    });
    
    Route::middleware('role:admin,tiket')->group(function(){
    Route::resource('/order-ticket', OrderController::class);
    Route::resource('/ticket-type', TicketTypeController::class);
    });

});


    Route::resource('/order-ticket', PublicOrderController::class);
    Route::resource('/restaurant-menu', PublicRestaurantMenuController::class);
    Route::resource('/restaurant-order', PublicRestaurantOrderController::class);
    Route::resource('/service', PublicServiceController::class);
    Route::get('/',[HomeController::class, 'index'])->name('home');


