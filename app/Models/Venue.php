<?php

namespace App\Models;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Venue extends Model implements HasMedia
{
	use InteractsWithMedia;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'town',
		'map',
		'text',
		'website',
		'address',
		'has_page',
		'in_menu'
	];

	/**
	 * Get all of the Venue's schedules.
	 */
	public function schedules(): HasMany
	{
		return $this->hasMany(Schedule::class);
	}

	/**
	 * Spatie Media Library collections.
	 */
	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('images')
			->acceptsMimeTypes(['image/jpeg', 'image/svg+xml', 'image/png', 'image/apng', 'image/jp2', 'image/gif', 'image/webp']);
	}

	/**
	 * Get the filament form CRUD configuration.
	 */
	public static function getForm(): array
	{
		return [
			TextInput::make('name')
				->required()
				->maxLength(191)
				->columnSpanFull()
				->translateLabel(),
			TextInput::make('town')
				->required()
				->maxLength(191)
				->translateLabel(),
			TextInput::make('address')
				->maxLength(191)
				->prefixIcon('bx-map-alt')
				->translateLabel(),
			TextInput::make('map')
				->maxLength(255)
				->url()
				->prefixIcon('bx-map')
				->placeholder('https://www.google.com/maps/place/...')
				->translateLabel(),
			TextInput::make('website')
				->maxLength(255)
				->url()
				->prefixIcon('bx-link-alt')
				->placeholder('https://')
				->translateLabel(),
			Section::make('Páxina')
				->schema([
					Toggle::make('has_page')
						->label('Ten páxina propia')
						->live()
						->afterStateUpdated(function (bool $state, Get $get, Set $set) {
							if (!$state && $get('in_menu')) {
								$set('in_menu', false);
							}
						}),
					Toggle::make('in_menu')
						->label('Aparece no menú da web')
						->disabled(fn(Get $get) => $get('has_page') == false),
					MarkdownEditor::make('content')
						->disableToolbarButtons([
							'blockquote',
							'codeBlock',
							'strike',
						])
						->label('Contido da páxina propia')
						->columnSpanFull()
						->requiredIf('has_page', true)
						->helperText('Texto que se mostrará en la propia página del lugar.')
				])
				->columns(2)
		];
	}
}
