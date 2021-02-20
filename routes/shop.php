<?php

use App\Http\Controllers\Shop\Category\IndexCategoryController;
use App\Http\Controllers\Shop\Category\ShowCategoryController;
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
