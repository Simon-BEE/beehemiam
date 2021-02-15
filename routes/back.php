<?php

use App\Http\Controllers\Admin\Category\CreateCategoryController;
use App\Http\Controllers\Admin\Category\DeleteCategoryController;
use App\Http\Controllers\Admin\Category\EditCategoryController;
use App\Http\Controllers\Admin\Category\IndexCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Products\CreateProductController;
use App\Http\Controllers\Admin\Products\DeleteProductController;
use App\Http\Controllers\Admin\Products\EditProductController;
use App\Http\Controllers\Admin\Products\IndexProductController;
use App\Http\Controllers\Admin\Products\Options\DeleteOptionController;
use App\Http\Controllers\Admin\Products\Options\EditOptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Back Routes
|--------------------------------------------------------------------------
|
| Only admin routes are here
|
*/

Route::get('/', DashboardController::class)->name('dashboard');

/**
 * Products routes
 */
Route::group(['as' => 'products.', 'prefix' => 'produits'], function () {

    Route::get('/', IndexProductController::class)->name('index');

    Route::post('/', [CreateProductController::class, 'store'])->name('store');
    Route::get('/creer', [CreateProductController::class, 'create'])->name('create');

    Route::get('/{product}/editer', [EditProductController::class, 'edit'])->name('edit');
    Route::patch('/{product}', [EditProductController::class, 'update'])->name('update');

    Route::delete('/{product}', DeleteProductController::class)->name('destroy');

    /**
     * Product Options routes
     */
    Route::group(['as' => 'options.', 'prefix' => 'options'], function () {

        Route::get('/{product}/{productOption}/editer', [EditOptionController::class, 'edit'])->name('edit');
        Route::patch('/{product}/{productOption}', [EditOptionController::class, 'update'])->name('update');

        Route::delete('/{product}/{productOption}', DeleteOptionController::class)->name('destroy');
    });
});

/**
 * Categories routes
 */
Route::group(['as' => 'categories.', 'prefix' => 'categories'], function () {

    Route::get('/', IndexCategoryController::class)->name('index');

    Route::get('/creer', [CreateCategoryController::class, 'create'])->name('create');
    Route::post('/', [CreateCategoryController::class, 'store'])->name('store');

    Route::get('/{category}/editer', [EditCategoryController::class, 'edit'])->name('edit');
    Route::patch('/{category}', [EditCategoryController::class, 'update'])->name('update');

    Route::delete('/{category}', DeleteCategoryController::class)->name('destroy');
});
