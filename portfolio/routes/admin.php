<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ConfigController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Config routes
Route::group([
    'middleware' => ['auth', 'admin']
], function () {
    Route::get('configs', [ConfigController::class, 'edit'])->name('admin.configs.edit');
    Route::post('configs', [ConfigController::class, 'update'])->name('admin.configs.update');

    //categories
    Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::post('/toggle-status/{id}', [CategoryController::class, 'toggleStatus'])->name('admin.categories.toggleStatus');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('admin.categories.show');

});
});
