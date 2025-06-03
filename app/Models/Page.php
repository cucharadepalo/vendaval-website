<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Page extends Model implements HasMedia
{
	use InteractsWithMedia, SoftDeletes;

	protected $fillable = [
		'title',
		'slug',
		'type',
		'content',
		'is_published',
		'in_menu'
	];

	/**
	 * Spatie Media Library collections.
	 */
	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('images')
			->acceptsMimeTypes(['image/jpeg', 'image/svg+xml', 'image/png', 'image/apng', 'image/jp2', 'image/gif', 'image/webp']);
	}

	/**
	 * Devuelve el link de la página.
	 */
	public function getLink(): string
	{
		$url = config('app.url');

		if ($this->slug !== 'home') {
			$url .= '/' . $this->slug;
		}

		return $url;
	}
}
