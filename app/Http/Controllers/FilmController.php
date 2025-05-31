<?php

namespace App\Http\Controllers;

use App\Models\Edition;
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

			$filmes = $this->edition->films;

			return view('filmes', compact('filmes'));

		}
	}
}
