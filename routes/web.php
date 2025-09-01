<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/series/{slug}', [SeriesController::class, 'show'])->name('series.show');
