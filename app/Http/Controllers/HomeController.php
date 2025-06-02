<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(Request $request)
	{
		$page = Page::whereSlug('home')->first();

		return view('home', compact('page'));
	}
}
