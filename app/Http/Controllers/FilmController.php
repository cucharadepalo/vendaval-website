<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FilmController extends Controller
{
	/**
	 * Create a new Film Controller.
	 */
	public function __construct(
		protected null | Edition $edition,
	) {
		$this->edition = Edition::where('is_active', 1)->first();
	}

	/**
	 * Show the Film list page.
	 */
	public function index(Request $request): View
	{
		if (! $this->edition) {

			return view('inactive');

		} else {

			$filmes = $this->edition->films->sortBy('title');

			return view('filmes', compact('filmes'));

		}
	}

	/**
	 * Show th Film information page.
	 */
	public function show(Request $request, string $slug): View
	{
		$film = Film::whereSlug($slug)->first();

		abort_if(! $film, 404);

		return view('film', compact('film'));
	}
}
