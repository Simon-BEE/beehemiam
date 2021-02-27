<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('inscription', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('inscription', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('connexion', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('connexion', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('mot-de-passe-oublie', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('mot-de-passe-oublie', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('reinitialiser-mot-de-passe/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('reinitialiser-mot-de-passe', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('verification-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('verification-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('confirmation-mot-de-passe', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('confirmation-mot-de-passe', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('deconnexion', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
