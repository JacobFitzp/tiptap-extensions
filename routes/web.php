<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Misc routes.
Route::get('/', HomeController::class)
    ->name('home');

// Authentication routes.
Route::get('/auth/redirect', [AuthController::class, 'redirect'])
    ->name('auth.redirect');
Route::get('/auth/callback', [AuthController::class, 'callback'])
    ->name('auth.callback');
Route::get('/auth/logout', [AuthController::class, 'logout'])
    ->name('auth.logout');

// Routes requiring authentication.
Route::middleware('auth')->group(function () {

    // Extension routes.
    Route::get('extensions/submit', [ExtensionController::class, 'submit'])
        ->name('extensions.submit');
    Route::post('extensions/submit', [ExtensionController::class, 'handleSubmit'])
        ->name('extensions.submit.handle');
});
