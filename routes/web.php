<?php

use App\Http\Controllers\DiscountController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\KasirMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\penggunaanBarang;
use App\Http\Controllers\stokBarangController;

Route::resource('menus', MenuController::class);
Route::resource('Diskon', DiscountController::class);
Route::resource('metode-pembayaran', PaymentMethodController::class);
Route::resource('stok', stokBarangController::class);
Route::resource('penggunaan', penggunaanBarang::class);




// Route::get('/', function () {
//     return view('welcome');
// })->name('dashboard');

Route::get('/dashboard/admin', [IndexController::class, 'allData1'])->name('admin')->middleware(['auth', AdminMiddleware::class]);
Route::get('/dashboard/kasir', [IndexController::class, 'allData2'])->name('kasir')->middleware(['auth', KasirMiddleware::class]);


Route::get('/login', function () {
    return view('login');
})->name('login.form');

Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/register', function () {
    return view('register');
})->name('register.form');

Route::post('/register', [RegisterController::class, 'register'])->name('register');



