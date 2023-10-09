<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\adminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/#cuntomer_signup
Route::post('/signup', [UserController::class, 'signUp']);
Route::post('/signin', [UserController::class, 'signIn']);
Route::post('/cuntomer_signup', [CustomersController::class, 'customer_signup']);

Route::middleware('approved.customer')->group(function () {
    
Route::post('/customer_signin', [CustomersController::class, 'customer_signin']);
});

Route::group(['middleware' => 'admin'], function () {

    Route::get('/pending', [adminController::class, 'showPendingCustomers']);
    Route::put('/{customerId}/approve', [adminController::class, 'approveCustomer']);

});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
