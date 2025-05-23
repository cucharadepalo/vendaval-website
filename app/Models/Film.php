<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Support\Enums\Alignment;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Film extends Model implements HasMedia
{
	use HasFactory, InteractsWithMedia;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'director',
		'year',
		'genre',
		'language',
		'version',
		'duration',
		'text',
	];

	/**
	 * Get all of the film's schedules.
	 *
	 */
	public function schedules(): MorphMany
	{
		return $this->morphMany(Schedule::class, 'schedulable');
	}

	/**
	 * Get the film edition(s).
	 */
	public function editions(): BelongsToMany
	{
		return $this->belongsToMany(Edition::class);
	}

	/**
	 * Get the filament form CRUD configuration.
	 *
	 */
	public static function getForm(): array
	{
		return [
			Grid::make(5)
				->schema([
					Section::make()
						->columnSpan(3)
						->columns(2)
						->schema([
							Select::make('editions')
								->label('Edición(s) da Mostra')
								->multiple()
								->relationship(titleAttribute: 'name')
								->default(function () {
									$active_edition = Edition::where('is_active', 1)->first();
									return [$active_edition ? $active_edition->id : null];
								})
								->options(Edition::all()->pluck('name', 'id'))
								->required()
								->columnSpan(1),
							TextInput::make('title')
								->required()
								->maxLength(191)
								->columnSpanFull()
								->translateLabel(),
							TextInput::make('director')
								->required()
								->maxLength(191)
								->translateLabel(),
							TextInput::make('year')
								->numeric()
								->minValue(1900)
								->maxValue(2100)
								->placeholder(2000)
								->translateLabel(),
							TextInput::make('genre')
								->maxLength(191)
								->helperText('Ex: Documentario o Ficción... ')
								->translateLabel(),
							TextInput::make('duration')
								->numeric()
								->minValue(1)
								->maxValue(600)
								->suffix('Minutos')
								->translateLabel(),
							TextInput::make('language')
								->maxLength(191)
								->placeholder('PT')
								->translateLabel(),
							TextInput::make('version')
								->maxLength(191)
								->helperText('Ex: Versión orixinal con subtítulos en...')
								->translateLabel(),
							MarkdownEditor::make('text')
								->disableToolbarButtons([
									'attachFiles',
									'codeBlock',
									'strike',
								])
								->minHeight('24rem')
								->columnSpanFull()
								->translateLabel(),
						]),
					Group::make()
						->columnSpan(2)
						->schema([
							Section::make()
								->schema([
									SpatieMediaLibraryFileUpload::make('poster')
										->collection('poster')
										->conversion('preview'),
									SpatieMediaLibraryFileUpload::make('stills')
										->collection('stills')
										->multiple()
										->conversion('preview')
							]),
							Section::make()
								->schema([
									Repeater::make('schedules')
										->label('Proxeccións')
										->relationship()
										->addActionAlignment(Alignment::Start)
										->addActionLabel('Añadir proxección')
										->schema(Schedule::getForm())
								])
						])
				])
		];
	}

	/**
	 * Spatie Media library collections.
	 */
	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('poster')
			->singleFile()
			->acceptsMimeTypes(['image/jpeg', 'image/svg+xml', 'image/png', 'image/apng', 'image/jp2', 'image/gif', 'image/webp']);

		$this->addMediaCollection('stills')
			->acceptsMimeTypes(['image/jpeg', 'image/svg+xml', 'image/png', 'image/apng', 'image/jp2', 'image/gif', 'image/webp']);
	}

	/**
	 * Generate thumbnail media conversion for Spatie media library.
	 *
	 */
	public function registerMediaConversions(?Media $media = null): void
	{
		$this->addMediaConversion('preview')
			->fit(Fit::Contain, 427, 640)
			->nonQueued();
	}
}
