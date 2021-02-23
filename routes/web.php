<?php

use App\Http\Controllers\Api\Cart\AddCartController;
use App\Http\Controllers\Api\Cart\UpdateCartController;
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

// Route::get('test', function () {
//     // return new \App\Mail\Users\PasswordHasChangedMail(auth()->user());
//     return (new \App\Notifications\VerifyEmailQueued)->toMail(auth()->user());
// });
Route::group(['prefix' => 'api', 'as' => 'api.'], function () {

    Route::group(['as' => 'cart.'], function () {
        Route::post('/cart/add/sizes/{productOptionSize}', AddCartController::class)->name('add.sizes');

        Route::patch('/cart/update/sizes/{productOptionSize}', UpdateCartController::class)->name('update.sizes');
    });
});

Route::get('/', WelcomeController::class)->name('welcome');

Route::personalDataExports('personal-data-exports');

require __DIR__.'/auth.php';
