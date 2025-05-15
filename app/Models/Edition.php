<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Edition extends Model implements HasMedia
{
	use InteractsWithMedia;

	protected $fillable = [
		'name',
		'date',
		'title',
		'is_active',
		'colors',
		'splash_alt_text'
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'date' => 'datetime',
		];
	}

	/**
	 * Get the films of the edition.
	 */
	public function films(): HasMany
	{
		return $this->hasMany(Film::class);
	}

	/**
	 * Get the activities of the edition.
	 */
	public function activities(): HasMany
	{
		return $this->hasMany(Activity::class);
	}

	/**
	 * Spatie Media Library collections.
	 */
	public function registerMediaCollections(): void
	{
    $this->addMediaCollection('splash')
			->singleFile()
			->acceptsMimeTypes(['image/jpeg', 'image/svg+xml', 'image/png', 'image/apng', 'image/jp2', 'image/gif', 'image/webp']);
	}
}
