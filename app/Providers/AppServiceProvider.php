<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		// Custom Polymorphic types for filmes and activities
		Relation::enforceMorphMap([
			'film' => 'App\Models\Film',
			'activity' => 'App\Models\Activity',
			'edition' => 'App\Models\Edition',
			'venue' => 'App\Models\Venue'
		]);
	}
}
