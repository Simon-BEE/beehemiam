<?php

use App\Http\Controllers\Api\Cart\AddCartController;
use App\Http\Controllers\Api\Cart\UpdateCartController;
use App\Http\Controllers\Api\Products\ProductOptionImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => [], 'as' => 'api.'], function () {

    Route::group(['prefix' => config('auth.protected_token')], function () {
        
        Route::delete('/produits/options/images/{image}/delete', [ProductOptionImageController::class, 'destroy'])
            ->name('products.options.images.delete');
    });
});
