<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Schedule;
use App\Models\Venue;

class ScheduleFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Schedule::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'start_time' => fake()->dateTime(),
			'notes' => fake()->word(),
			'schedulable_id' => fake()->randomNumber(),
			'schedulable_type' => fake()->word(),
			'venue_id' => Venue::factory(),
		];
	}
}
