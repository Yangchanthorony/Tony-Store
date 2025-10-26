<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Models\category;
use App\Models\product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

use App\Http\Controllers\TelegramController;

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


// This is the API route your JavaScript will call in telegram
Route::post('/send-telegram', [TelegramController::class, 'send'])->name('send.telegram');
Route::post('/send-order-telegram', [TelegramController::class, 'sendOrder'])
     ->name('telegram.sendOrder');

     



Route::resource('/products', App\Http\Controllers\productController::class);


Route::resource('/categories', App\Http\Controllers\categoryController::class);

Route::resource('/employees', App\Http\Controllers\employeeController::class);

Route::resource('/staff', App\Http\Controllers\staffController::class);

Route::resource('/customers', App\Http\Controllers\customerController::class);




















Route::get('/a', function () {
    return view('checkout'); // We will create this view next
});

// web.php
Route::get("/send-message", function() {
    Telegram::sendMessage([
        'chat_id' => '1946678779',
        'text' => 'Hello from bros vong!'
    ]);
    return "Message sent!";
})->name('send.message');

