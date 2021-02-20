<?php

use App\Http\Controllers\Shop\Category\IndexCategoryController;
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
});
