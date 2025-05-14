<?php

use App\Http\Controllers\web\HomepageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\web\AboutController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\CustomerController;
use App\Http\Controllers\web\InvoiceController;
use App\Http\Controllers\web\PricingController;
use App\Http\Controllers\web\ServiceController;
use App\Http\Controllers\web\WalletController;

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

Route::get('/service/{slug}', [HomepageController::class, 'detail'])->name('service.detail');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'about-us'], function () {
    Route::get('/', [AboutController::class, 'index'])->name('about.index');
});
Route::group(['prefix' => 'contacts'], function () {
    Route::get('/', [ContactController::class, 'index'])->name('contact.index');
});
Route::group(['prefix' => 'services'], function () {
    Route::get('/', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/{slug}', [HomepageController::class, 'detail'])->name('service.detail');
});
Route::group(['prefix' => 'price'], function () {
    Route::get('/', [PricingController::class, 'index'])->name('pricing.index');
});
Route::group(['prefix' => 'invoice'], function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
});

Route::group(['prefix' => 'category'], function () {
   Route::get('/{categorySlug}', [HomepageController::class, 'category'])->name('category.detail');
});

// Frontend Routes (yêu cầu đăng nhập)
Route::group([
    'middleware' => ['frontend.auth']
], function () {
    // Customer Profile
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/profile', [CustomerController::class, 'showProfile'])->name('customer.profile');
        Route::put('/profile/update', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
    });

    // Checkout Routes
    Route::group(['prefix' => 'checkout', 'as' => 'checkout.'], function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/process', [CheckoutController::class, 'process'])->name('process');
        Route::get('/success/{order}', [CheckoutController::class, 'success'])->name('success');
    });

// routes/web.php

// Wallet routes (yêu cầu đăng nhập)
Route::group([ 'prefix' => 'wallet'], function () {
    Route::get('/deposit', [WalletController::class, 'deposit'])->name('deposit');
    Route::post('/deposit/process', [WalletController::class, 'processDeposit'])->name('deposit.process');
    Route::get('/deposit/success/{code}', [WalletController::class, 'depositSuccess'])->name('deposit.success');
});
});

