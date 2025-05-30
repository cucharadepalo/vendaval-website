<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/programa', [ScheduleController::class, 'index']);
Route::get('/programa/{slug}', [ScheduleController::class, 'show']);
