<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Film;

class FilmFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Film::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'title' => fake()->sentence(4),
			'slug' => fake()->slug(),
			'director' => fake()->regexify('[A-Za-z0-9]{191}'),
			'year' => fake()->year(),
			'genre' => fake()->regexify('[A-Za-z0-9]{191}'),
			'country' => fake()->regexify('[A-Za-z0-9]{191}'),
			'version' => fake()->regexify('[A-Za-z0-9]{191}'),
			'duration' => fake()->time(),
			'text' => fake()->text(),
		];
	}
}
