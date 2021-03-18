<?php

use App\Http\Controllers\Admin\Category\CreateCategoryController;
use App\Http\Controllers\Admin\Category\DeleteCategoryController;
use App\Http\Controllers\Admin\Category\EditCategoryController;
use App\Http\Controllers\Admin\Category\IndexCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Discount\CreateCouponController;
use App\Http\Controllers\Admin\Discount\DeleteCouponController;
use App\Http\Controllers\Admin\Discount\EditCouponController;
use App\Http\Controllers\Admin\Discount\IndexDiscountController;
use App\Http\Controllers\Admin\Order\IndexOrderController;
use App\Http\Controllers\Admin\Order\ShowOrderController;
use App\Http\Controllers\Admin\Order\StatusOrderController;
use App\Http\Controllers\Admin\Products\CreateProductController;
use App\Http\Controllers\Admin\Products\DeleteProductController;
use App\Http\Controllers\Admin\Products\EditProductController;
use App\Http\Controllers\Admin\Products\IndexProductController;
use App\Http\Controllers\Admin\Products\Options\DeleteOptionController;
use App\Http\Controllers\Admin\Products\Options\EditOptionController;
use App\Http\Controllers\Admin\Users\DeleteUserController;
use App\Http\Controllers\Admin\Users\EditUserController;
use App\Http\Controllers\Admin\Users\IndexUserController;
use App\Http\Controllers\Admin\Users\ShowUserController;
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

/**
 * Users routes
 */
Route::group(['as' => 'users.', 'prefix' => 'clients'], function () {

    Route::get('/', IndexUserController::class)->name('index');

    Route::get('/{user}', [ShowUserController::class, 'show'])->name('show');
    Route::get('/{user}/commandes', [ShowUserController::class, 'orders'])->name('orders');

    Route::get('/{user}/editer', [EditUserController::class, 'edit'])->name('edit');
    Route::patch('/{user}', [EditUserController::class, 'update'])->name('update');
    Route::patch('/{user}/password', [EditUserController::class, 'updatePassword'])->name('update.password');

    Route::post('/{user}/features/resend-verification-email', [ShowUserController::class, 'sendEmailVerification'])
        ->name('features.resend-verification-email');

    Route::delete('/{user}', DeleteUserController::class)->name('destroy');
});

/**
 * Discount routes
 */
Route::group(['as' => 'discount.', 'prefix' => 'promotions'], function () {

    Route::get('/', IndexDiscountController::class)->name('index');

    Route::group(['as' => 'coupons.', 'prefix' => 'coupons'], function () {

        Route::get('/creer', [CreateCouponController::class, 'create'])->name('create');
        Route::post('/', [CreateCouponController::class, 'store'])->name('store');

        Route::get('/{coupon}/editer', [EditCouponController::class, 'edit'])->name('edit');
        Route::patch('/{coupon}', [EditCouponController::class, 'update'])->name('update');

        Route::delete('/{coupon}', DeleteCouponController::class)->name('destroy');
    });
});

/**
 * Orders routes
 */
Route::group(['as' => 'orders.', 'prefix' => 'commandes'], function () {

    Route::get('/', IndexOrderController::class)->name('index');
    Route::get('/{order}', [ShowOrderController::class, 'show'])->name('show');
    Route::delete('/{order}', [ShowOrderController::class, 'cancel'])->name('cancel');

    Route::get('/{order}/statut', [StatusOrderController::class, 'edit'])->name('status.edit');
    Route::patch('/{order}/statut', [StatusOrderController::class, 'update'])->name('status.update');
});
