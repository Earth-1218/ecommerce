<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/', [ProductController::class,'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/product',ProductController::class);
Route::resource('/order',OrderController::class)->middleware('auth');
Route::post('/createCart',[CartController::class,'createCart'])->name('createCart');
Route::get('/showCart',[CartController::class,'showCart'])->name('showCart');
Route::get('/cancelCart',[CartController::class,'cancelCart'])->name('cancelCart');
Route::post('/checkout',[CartController::class,'checkout'])->middleware('auth')->name('checkout');

//api route
Route::post('/addToCart',[CartController::class,'addToCart'])->name('addToCart');
Route::get('/removeFromCart/{productId}',[CartController::class,'removeFromCart'])->name('removeFromCart');


