<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\test;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
//Auth::routes();

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

Route::get('add_hotel2', 'App\Http\Controllers\test@add_hotel2');
Route::post('add_hotel', 'App\Http\Controllers\test@add_hotel');


Route::get('/', function () {
    return view('welcome');
});


//require __DIR__.'/auth.php';

