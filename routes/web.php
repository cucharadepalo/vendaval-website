<?php

use App\Models\Page;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Route::get('/', HomeController::class)->name('home');
Route::get('/programa', [ScheduleController::class, 'index'])->name('schedule');
Route::get('/programa/{slug}', [ScheduleController::class, 'show'])->name('activity');
Route::get('/ribeira-sacra', [ScheduleController::class, 'where'])->name('where');
Route::get('/filmes', [FilmController::class, 'index'])->name('filmes');
Route::get('/filmes/{slug}', [FilmController::class, 'show'])->name('film');
Route::get('/{slug}', function (string $slug): View {
	$page = Page::where('type', '!=', 'system')
						->where('is_published', 1)
						->whereSlug($slug)
						->first();

	abort_if(! $page, 404);

	return view('page', compact('page'));
});
