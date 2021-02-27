<?php

use App\Http\Controllers\Shop\Category\IndexCategoryController;
use App\Http\Controllers\Shop\Category\ShowCategoryController;
use App\Http\Controllers\Shop\Product\ShowProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Shop Routes
|--------------------------------------------------------------------------
|
| Only shop routes are here
|
*/

Route::group(['as' => 'categories.'], function () {

    Route::get('/', IndexCategoryController::class)->name('index');
    Route::get('/{category:slug}', ShowCategoryController::class)->name('show');
});

Route::group(['as' => 'products.'], function () {

    Route::get('/{category:slug}/{product:slug}', ShowProductController::class)->name('show');
});
