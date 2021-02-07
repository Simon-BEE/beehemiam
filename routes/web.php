<?php

use App\Http\Controllers\User\DashboardController as UserDashboardController;
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

Route::get('/', WelcomeController::class)->name('welcome');


Route::group(['middleware' => ['auth']], function () {
    
    Route::group(['as' => 'user.'], function () {

        Route::get('mon-compte', UserDashboardController::class)->name('dashboard');
    });
});


require __DIR__.'/auth.php';
