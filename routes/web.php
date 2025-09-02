<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/series/{slug}', [SeriesController::class, 'show'])->name('series.show');
Route::get('/series/{slug}/play/{episodeId}', [SeriesController::class, 'play'])->name('series.play');
Route::get('/stream/episode/{episodeId}', [SeriesController::class, 'streamVideo'])
    ->middleware('auth')
    ->name('series.stream');

Route::get('/register', [AuthController::class, 'registerForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('auth.register.store');
