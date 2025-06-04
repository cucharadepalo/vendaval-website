<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Edition;
use App\Models\Page;
use App\Models\Schedule;
use Carbon\Carbon;
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

			$squery = Schedule::whereBetween('start_time', [$start_date, $end_date])->get();

			if (! $squery->count()) {

				return view('inactive');

			} else {

				// Agrupamos por días y horas
				// OJO: Cualquier acto que empiece antes de las 2:01 de la mañana se agrupa con el dia anterior
				$schedules = $squery->groupBy(function (Schedule $item, int $key) {
					$day = Carbon::parse($item->start_time)->subHours(2);
					return $day->startOfDay()->format('Y-m-d');
				});

				$page = Page::whereSlug('programa')->first();

				return view('schedule', compact(['schedules', 'start_date', 'end_date', 'page']));

			}
		}
	}

	/**
	 * Show the Activity details page.
	 */
	public function show(Request $request, string $slug): View
	{
		$activity = Activity::whereSlug($slug)->first();

		abort_if(! $activity, 404);

		return view('activity', compact('activity'));
	}

	/**
	 * Show the venues list.
	 */
	public function where(Request $request): View
	{
		$page = Page::whereSlug('ribeira-sacra')->first();
		$venues = collect();
		$schedules = $this->edition->schedules;

		foreach ($schedules as $schedule) {
			$venues->push($schedule->venue);
		}

		$venues = $venues->unique()->sortByDesc('text');

		return view('where', compact('venues', 'page'));
	}

}
