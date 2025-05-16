<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Venue;

class VenueFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Venue::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'name' => fake()->name(),
			'town' => fake()->regexify('[A-Za-z0-9]{191}'),
			'map' => fake()->regexify('[A-Za-z0-9]{191}'),
			'text' => fake()->text(),
			'website' => fake()->word(),
		];
	}
}
