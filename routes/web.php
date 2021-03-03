<?php

use App\Http\Controllers\Api\Cart\AddCartController;
use App\Http\Controllers\Api\Cart\ApiCouponController;
use App\Http\Controllers\Api\Cart\RemoveCartController;
use App\Http\Controllers\Api\Cart\UpdateCartController;
use App\Http\Controllers\Shop\Cart\AddressCartController;
use App\Http\Controllers\Shop\Cart\IndexCartController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    dd(redirect()->intended(), session('url.intended'));
});

/**
 * Cart api routes
*/
Route::group(['prefix' => 'api', 'as' => 'api.'], function () {

    Route::group(['as' => 'cart.', 'prefix' => 'cart'], function () {
        Route::post('/add/sizes/{productOptionSize}', [AddCartController::class, 'addOrder'])->name('add.sizes');
        Route::patch('/update/sizes/{productOptionSize}', [UpdateCartController::class, 'updateOrder'])
            ->name('update.sizes');
        Route::delete('/delete/sizes/{productOptionSize}', [RemoveCartController::class, 'deleteOrder'])
            ->name('delete.sizes');

        Route::post('/add/preorder', [AddCartController::class, 'addPreOrder'])->name('add.preorder');
        Route::patch('/update/preorder', [UpdateCartController::class, 'updatePreOrder'])
            ->name('update.preorder');
        Route::patch('/delete/preorder', [RemoveCartController::class, 'deletePreOrder'])
            ->name('delete.preorder');

        Route::post('/coupons/add', ApiCouponController::class)->name('coupons.add');
    });
});

Route::group(['prefix' => 'panier', 'as' => 'cart.'], function () {
    
    Route::get('/', IndexCartController::class)->name('index');

    Route::get('/livraisons', [AddressCartController::class, 'index'])->name('shippings.index');
    Route::post('/livraisons', [AddressCartController::class, 'store'])->name('shippings.store');
});

Route::get('/', WelcomeController::class)->name('welcome');

Route::personalDataExports('personal-data-exports');

require __DIR__.'/auth.php';
