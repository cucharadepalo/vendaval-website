<?php

namespace App\Providers;

use App\View\Composers\EditionComposer;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		$this->app->bind('path.public', function() {
			return realpath(base_path('www'));
		});
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

		Facades\View::composer('*', EditionComposer::class);
	}
}
