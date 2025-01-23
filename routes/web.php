<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Landing page (accessible without login)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin dashboard (using Filament, already configured)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
