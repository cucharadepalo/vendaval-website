<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Support\Enums\Alignment;
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
		'slug',
		'director',
		'year',
		'genre',
		'country',
		'version',
		'duration',
		'text',
	];

	/**
	 * Get all of the film's schedules.
	 *
	 */
	public function schedules(): MorphToMany
	{
		return $this->morphToMany(Schedule::class, 'schedulable')->withTimestamps();
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
								->unique(ignoreRecord: true)
								->validationMessages(['unique' => 'Este film xa existe.'])
								->maxLength(191)
								->minLength(2)
								->columnSpanFull()
								->translateLabel()
								->live(onBlur: true)
								->afterStateUpdated(function (Forms\Set $set, Forms\Get $get, ?string $state): void {
										$set('slug', Str::slug($state));
								}),
							Hidden::make('slug')
								->required()
								->unique(ignoreRecord: true),
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
							TextInput::make('country')
								->maxLength(191)
								->placeholder('PT')
								->translateLabel(),
							TextInput::make('version')
								->maxLength(191)
								->helperText('Ex: Versión orixinal con subtítulos en...')
								->translateLabel(),
							MarkdownEditor::make('text')
								->required()
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
										->panelAspectRatio('4:5')
										->disk('media')
										->responsiveImages(),
									SpatieMediaLibraryFileUpload::make('stills')
										->label('Imaxe')
										->collection('stills')
										->conversion('still_opt')
										->panelAspectRatio('16:9')
										// ->multiple()
										->disk('media'),
							]),
							Section::make()
								->schema([
									Repeater::make('schedules')
										->label('Proxeccións')
										->relationship()
										->addActionAlignment(Alignment::Start)
										->addActionLabel('Añadir proxección')
										->schema(Schedule::getForm()),
									Placeholder::make('about_schedules')
										->hiddenLabel()
										->content(new HtmlString('<div class="font-medium">Se o filme se vai programar xunto con outro ou con unha actividade, debes facer a asociación na sección do programa, seleccionando a sesión e engadíndoo alí.</div>'))
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
			->useDisk('media')
			->withResponsiveImages()
			->acceptsMimeTypes(['image/jpeg', 'image/svg+xml', 'image/png', 'image/apng', 'image/jp2', 'image/gif', 'image/webp']);

		$this->addMediaCollection('stills')
			->useDisk('media')
			->acceptsMimeTypes(['image/jpeg', 'image/svg+xml', 'image/png', 'image/apng', 'image/jp2', 'image/gif', 'image/webp']);
	}

	/**
	 * Generate thumbnail media conversion for Spatie media library.
	 *
	 */
	public function registerMediaConversions(?Media $media = null): void
	{
		$this->addMediaConversion('poster_thumbnail')
			->fit(Fit::Fill, 86, 128)
			->performOnCollections('poster')
			->quality(75)
			->format('webp')
			->nonQueued();

		$this->addMediaConversion('still_opt')
			->fit(Fit::Contain, 1600, 900)
			->performOnCollections('stills')
			->quality(85)
			->format('webp')
			->withResponsiveImages();
	}
}
