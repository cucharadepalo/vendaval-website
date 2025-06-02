<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	/**
	 * Create a new schedule controller.
	 */
	public function __construct(
		protected null | Edition $edition,
	) {
		$this->edition = Edition::where('is_active', 1)->first();
	}

	/**
	 * Handle the incoming request.
	 */
	public function __invoke(Request $request)
	{
		$page = Page::whereSlug('home')->first();

		return view('home', compact('page'));
	}
}
