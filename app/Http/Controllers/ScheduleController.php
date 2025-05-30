<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Schedule;
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
		if (! $this->edition) {

			return view('inactive');

		} else {

			$start_date = $this->edition->start_date;
			$end_date = $this->edition->end_date;

			$schedules = Schedule::whereBetween('start_time', [$start_date, $end_date])->get();

			return view('schedule', compact(['schedules', 'start_date', 'end_date']));
		}

	}
}
