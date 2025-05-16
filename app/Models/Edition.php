<?php

namespace App\Models;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edition extends Model implements HasMedia
{
	use InteractsWithMedia;

	protected $fillable = [
		'name',
		'start_date',
		'end_date',
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
			'start_date' => 'datetime',
			'end_date' => 'datetime'
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
			->acceptsMimeTypes(['image/jpeg', 'image/svg+xml', 'image/png', 'image/apng', 'image/jp2', 'image/gif', 'image/webp']);

		$this->addMediaCollection('og')
			->singleFile()
			->acceptsMimeTypes(['image/jpeg', 'image/svg+xml', 'image/png', 'image/apng', 'image/jp2', 'image/gif', 'image/webp']);
	}

	/**
	 * Generate thumbnail media conversion for Spatie media library.
	 *
	 */
	public function registerMediaConversions(?Media $media = null): void
	{
		$this->addMediaConversion('thumb')
			->fit(Fit::Contain, 300, 300)
			->nonQueued();
	}

	/**
	 * Get the filament CRUD form configuration.
	 */
	public static function getForm(): array
	{
		return [
			Grid::make(5)
				->schema([
					Section::make()
						->columnSpan(2)
						->columns(2)
						->schema([
							TextInput::make('name')
								->required()
								->maxLength(191)
								->label('Nome / Identificador / Ano')
								->placeholder('2025')
								->columnSpanFull(),
							TextInput::make('title')
								->maxLength(191)
								->label('Título')
								->placeholder('1º Mostra de Cinema Portugués...')
								->columnSpanFull(),
							DatePicker::make('start_date')
								->native(false)
								->locale('es')
								->required()
								->label('Data de inicio')
								->displayFormat('j / F / Y'),
							DatePicker::make('end_date')
								->native(false)
								->locale('es')
								->required()
								->label('Data final')
								->displayFormat('j / F / Y')
						]),
					Section::make('Deseño')
						->columnSpan(3)
						->columns(2)
						->schema([
							SpatieMediaLibraryFileUpload::make('landscape_splash')
								->label('Imaxe desktop')
								->disk('media')
								->collection('splash')
								->customProperties(['version' => 'landscape'])
								->maxSize(2048)
								->required()
								->panelAspectRatio('3:2')
								->image()
								->imageEditor()
								->imageEditorMode(1)
								->imageEditorViewportWidth(1200)
								->imageEditorViewportHeight(800)
								->columnSpanFull()
								->placeholder('Arrastra e solta o teu ficheiro ou faz click')
						])
				])
		];
	}
}
