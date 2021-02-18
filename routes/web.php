<?php

use App\Http\Controllers\User\Address\CreateAddressController;
use App\Http\Controllers\User\Address\DeleteAddressController;
use App\Http\Controllers\User\Address\EditAddressController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\EditUserController;
use App\Http\Controllers\User\UserProfileController;
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

Route::get('test', function () {
    // return new \App\Mail\Users\PasswordHasChangedMail(auth()->user());
    return (new \App\Notifications\VerifyEmailQueued)->toMail(auth()->user());
});

Route::get('/', WelcomeController::class)->name('welcome');


Route::group(['middleware' => ['auth']], function () {
    
    Route::group(['as' => 'user.'], function () {
        
        Route::group(['prefix' => 'mon-compte'], function () {

            Route::group(['as' => 'profile.'], function () {
                Route::get('/', UserDashboardController::class)->name('dashboard');

                Route::get('/editer', [EditUserController::class, 'edit'])->name('edit');
                Route::patch('/', [EditUserController::class, 'update'])->name('update');
                Route::get('/mot-de-passe', [EditUserController::class, 'editPassword'])->name('edit.password');
                Route::patch('/mot-de-passe', [EditUserController::class, 'updatePassword'])->name('update.password');

                Route::post('email-verification', [UserProfileController::class, 'sendEmailVerification'])
                    ->name('email-verification');
            });

            Route::group(['as' => 'addresses.', 'prefix' => 'adresses'], function () {

                Route::get('/creer', [CreateAddressController::class, 'create'])->name('create');
                Route::post('/', [CreateAddressController::class, 'store'])->name('store');

                Route::get('/{address}/editer', [EditAddressController::class, 'edit'])->name('edit');
                Route::patch('/{address}', [EditAddressController::class, 'update'])->name('update');

                Route::delete('/{address}', DeleteAddressController::class)->name('destroy');
            });
        });
    });
});


require __DIR__.'/auth.php';
