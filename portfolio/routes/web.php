<?php

use App\Http\Controllers\web\HomepageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\web\AboutController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\InvoiceController;
use App\Http\Controllers\web\PricingController;
use App\Http\Controllers\web\ServiceController;

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

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/detail', [HomepageController::class, 'detail'])->name('detail');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'about-us'], function () {
    Route::get('/', [AboutController::class, 'index'])->name('about.index');
});
Route::group(['prefix' => 'contacts'], function () {
    Route::get('/', [ContactController::class, 'index'])->name('contact.index');
});
Route::group(['prefix' => 'services'], function () {
    Route::get('/', [ServiceController::class, 'index'])->name('services.index');
});
Route::group(['prefix' => 'price'], function () {
    Route::get('/', [PricingController::class, 'index'])->name('pricing.index');
});
Route::group(['prefix' => 'invoice'], function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
});
