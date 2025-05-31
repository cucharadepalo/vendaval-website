<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Activity;

class ActivityFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Activity::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'title' => fake()->sentence(4),
			'slug' => fake()->slug(),
			'summary' => fake()->text(),
			'text' => fake()->text(),
		];
	}
}
