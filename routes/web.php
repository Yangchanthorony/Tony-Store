<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Models\category;
use App\Models\product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
     $products = product::all();
     $categories = category::orderBy('order')->get();
    return view('welcome', compact('products', 'categories'));
})->name('views.welcome');

Route::get('/fornt/product', function () {
    $products = product::all();
    $categories = category::orderBy('order')->get();
    return view('fornt.product', compact('products', 'categories'));
})->name('views.product');


Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('registerPost');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('loginPost');


Route::get('/profile', [AuthController::class, 'profile'])->name('profile')->middleware('auth');


Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::resource('/products', App\Http\Controllers\productController::class);


Route::resource('/categories', App\Http\Controllers\categoryController::class);

Route::resource('/employees', App\Http\Controllers\employeeController::class);

Route::resource('/staff', App\Http\Controllers\staffController::class);

Route::resource('/customers', App\Http\Controllers\customerController::class);
