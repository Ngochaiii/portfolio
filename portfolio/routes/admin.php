<?php

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
});
