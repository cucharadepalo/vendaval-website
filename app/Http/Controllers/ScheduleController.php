<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleController extends Controller
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
	 * Show the Schedule list page.
	 */
	public function index(Request $request): View
	{
		return view('schedule.index');
	}
}
