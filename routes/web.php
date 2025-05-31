<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/programa', [ScheduleController::class, 'index'])->name('schedule');
Route::get('/programa/{slug}', [ScheduleController::class, 'show'])->name('activity');
Route::get('/filmes', [FilmController::class, 'index'])->name('filmes');
Route::get('/filmes/{slug}', [FilmController::class, 'show'])->name('film');
