<?php

use App\Http\Controllers\Shop\IndexShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Shop Routes
|--------------------------------------------------------------------------
|
| Only shop routes are here
|
*/

Route::get('/', IndexShopController::class)->name('index');