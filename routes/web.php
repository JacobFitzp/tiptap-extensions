<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Misc routes.
Route::get('/', HomeController::class)
    ->name('home');

// Authentication routes.
Route::redirect('/login', '/auth/redirect')
    ->name('login');
Route::get('/auth/redirect', [AuthController::class, 'redirect'])
    ->name('auth.redirect');
Route::get('/auth/callback', [AuthController::class, 'callback'])
    ->name('auth.callback');
Route::get('/auth/logout', [AuthController::class, 'logout'])
    ->name('auth.logout');

// Routes requiring authentication.
Route::middleware('auth')->group(function () {

    // Profile routes.
    Route::get('profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    // Extension routes.
    Route::get('extensions/submit', [ExtensionController::class, 'submit'])
        ->name('extensions.submit');
    Route::post('extensions/submit', [ExtensionController::class, 'store'])
        ->can('create,extension')
        ->name('extensions.store');
    Route::get('extensions/{extension:slug}/manage', [ExtensionController::class, 'manage'])
        ->can('update,extension')
        ->name('extensions.manage');
    Route::patch('extensions/{extension:slug}/manage', [ExtensionController::class, 'update'])
        ->can('update,extension')
        ->name('extensions.update');
});
