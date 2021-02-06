<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Products\CreateProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('dashboard');

Route::group(['as' => 'products.', 'prefix' => 'products'], function () {

    Route::post('/', [CreateProductController::class, 'store'])->name('store');
    Route::get('/creer', [CreateProductController::class, 'create'])->name('create');

});