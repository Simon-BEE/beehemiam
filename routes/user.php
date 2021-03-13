<?php

use App\Http\Controllers\User\Address\CreateAddressController;
use App\Http\Controllers\User\Address\DeleteAddressController;
use App\Http\Controllers\User\Address\EditAddressController;
use App\Http\Controllers\User\Address\IndexAddressController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\EditUserController;
use App\Http\Controllers\User\Order\ShowOrderController;
use App\Http\Controllers\User\SettingsUserController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Only user routes are here
|
*/

Route::group(['as' => 'profile.'], function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/editer', [EditUserController::class, 'edit'])->name('edit');
    Route::patch('/', [EditUserController::class, 'update'])->name('update');
    Route::get('/mot-de-passe', [EditUserController::class, 'editPassword'])->name('edit.password');
    Route::patch('/mot-de-passe', [EditUserController::class, 'updatePassword'])->name('update.password');

    Route::post('email-verification', [UserProfileController::class, 'sendEmailVerification'])
        ->name('email-verification');
});

Route::group(['as' => 'addresses.', 'prefix' => 'adresses'], function () {

    Route::get('/', IndexAddressController::class)->name('index');

    Route::get('/creer', [CreateAddressController::class, 'create'])->name('create');
    Route::post('/', [CreateAddressController::class, 'store'])->name('store');

    Route::get('/{address}/editer', [EditAddressController::class, 'edit'])->name('edit');
    Route::patch('/{address}', [EditAddressController::class, 'update'])->name('update');
    Route::patch('/{address}/main', [EditAddressController::class, 'setAsMain'])->name('update.main');

    Route::delete('/{address}', DeleteAddressController::class)->name('destroy');
});

Route::group(['as' => 'orders.', 'prefix' => 'commandes'], function () {

    Route::get('/', [ShowOrderController::class, 'index'])->name('index');
    Route::get('/{order}', [ShowOrderController::class, 'show'])->name('show');
});

Route::group(['as' => 'settings.', 'prefix' => 'parametres'], function () {

    Route::get('/', [SettingsUserController::class, 'index'])->name('index');

    Route::post('/donnees-personnelles', [SettingsUserController::class, 'personnalData'])->name('personnal-data');

    Route::get('/suppression/{user}', [SettingsUserController::class, 'deleteAccount'])->name('delete-account');
    Route::post('/suppression', [SettingsUserController::class, 'emailDeleteAccount'])->name('email-delete-account');
});
