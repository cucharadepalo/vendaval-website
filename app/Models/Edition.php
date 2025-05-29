<?php

namespace App\Models;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
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
			'end_date' => 'datetime',
			'colors' => 'array'
		];
	}

	/**
	 * Get the films of the edition.
	 */
	public function films(): BelongsToMany
	{
		return $this->belongsToMany(Film::class);
	}

	/**
	 * Get the activities of the edition.
	 */
	public function activities(): BelongsToMany
	{
		return $this->belongsToMany(Activity::class);
	}

	/**
	 * Scope a query to only include popular users.
	 */
	#[Scope]
	protected function active(Builder $query): void
	{
		$query->where('is_active', 1);
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
						->columnSpanFull()
						->columns(5)
						->schema([
							TextInput::make('name')
								->required()
								->maxLength(191)
								->label('Nome / Identificador / Ano')
								->placeholder('2025')
								->columnSpan(1),
							TextInput::make('title')
								->maxLength(191)
								->label('Título')
								->placeholder('1º Mostra de Cinema Portugués...')
								->columnSpan(2),
							DatePicker::make('start_date')
								->native(false)
								->locale('es')
								->required()
								->label('Data de inicio')
								->columnSpan(1)
								->displayFormat('j / F / Y'),
							DatePicker::make('end_date')
								->native(false)
								->locale('es')
								->required()
								->label('Data final')
								->columnSpan(1)
								->displayFormat('j / F / Y')
						]),
					Section::make('Deseño')
						->columnSpanFull()
						->columns(5)
						->schema([
							SpatieMediaLibraryFileUpload::make('landscape_splash')
								->label('Imaxe horizontal')
								->disk('media')
								->collection('splash')
								->customProperties(['version' => 'landscape'])
								->filterMediaUsing(
									fn(Collection $media, Get $get): Collection => $media->where(
										'custom_properties.version',
										'landscape'
									)
								)
								->maxSize(2048)
								->required()
								->panelAspectRatio('3:2')
								->image()
								->imageEditor()
								->imageEditorEmptyFillColor(function (Edition $record): null | string {
									return $record->colors[0]['color'];
								})
								->imageEditorViewportWidth(1200)
								->imageEditorViewportHeight(800)
								->columnSpan(3)
								->hint('1200×800px'),
							SpatieMediaLibraryFileUpload::make('portrait_splash')
								->label('Imaxe vertical')
								->disk('media')
								->collection('splash')
								->customProperties(['version' => 'portrait'])
								->filterMediaUsing(
									fn(Collection $media, Get $get): Collection => $media->where(
										'custom_properties.version',
										'portrait'
									)
								)
								->maxSize(2048)
								->required()
								->panelAspectRatio('1:1.015')
								->image()
								->imageEditor()
								->imageEditorEmptyFillColor(function (Edition $record): null | string {
									return $record->colors[0]['color'];
								})
								->imageEditorViewportWidth(800)
								->imageEditorViewportHeight(1200)
								->columnSpan(2)
								->hint('800×1200px'),
							TextInput::make('splash_alt_text')
								->label('Texto alternativo das imaxes')
								->required()
								->columnSpanFull()
								->helperText('Se as imaxes conteñen texto, escríbeo aquí para as tecnoloxías de asistencia. Se non, describe a imaxe')
								->maxLength(191)
								->hint('alt text'),
							SpatieMediaLibraryFileUpload::make('og_image')
								->label('Imaxe RRSS')
								->disk('media')
								->collection('og')
								->maxSize(2048)
								->panelAspectRatio('1.9:1')
								->hint('1200×630px')
								->image()
								->columnSpan(3)
								->helperText('Esta é a imaxe que se verá cando a páxina se comparta nas redes sociais.'),
							Repeater::make('colors')
								->label('Cores')
								->columnSpan(2)
								->schema([
									TextInput::make('name')
										->label('Nome')
										->readonly(),
									Hidden::make('variable'),
									ColorPicker::make('color')
										->regex('/^#([a-f0-9]{6}|[a-f0-9]{3})\b$/')
										->label('Cor')
								])
								->columns(2)
								->default(config('custom.edition.default_colors'))
								->addable(false)
								->deletable(false)
								->reorderable(false)
						])
				])
		];
	}
}
