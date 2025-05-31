<?php

namespace App\Models;

use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Support\Enums\Alignment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Activity extends Model implements HasMedia
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
		'summary',
		'text',
	];

	/**
	 * Get all of the activity's schedules.
	 */
	public function schedules(): MorphToMany
	{
		return $this->morphToMany(Schedule::class, 'schedulable');
	}

	/**
	 * Get the activity edition.
	 */
	public function editions(): BelongsToMany
	{
		return $this->belongsToMany(Edition::class);
	}

	/**
	 * Get the filament form CRUD configuration.
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
								->validationMessages(['unique' => 'Esta actividad xa existe.'])
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
							MarkdownEditor::make('summary')
								->required()
								->maxLength(255)
								->toolbarButtons([
									'bold',
									'italic',
									'link'
								])
								->minHeight('6rem')
								->translateLabel()
								->columnSpanFull(),
							MarkdownEditor::make('text')
								->disableToolbarButtons([
									'attachFiles',
									'codeBlock',
									'strike'
								])
								->minHeight('20rem')
								->translateLabel()
								->columnSpanFull(),
						]),
					Group::make()
						->columnSpan(2)
						->schema([
							Section::make()
								->schema([
									SpatieMediaLibraryFileUpload::make('image')
										->collection('image')
										->conversion('image_opt')
										->panelAspectRatio('3:2')
										->translateLabel()
								]),
							Section::make()
								->schema([
								Repeater::make('schedules')
									->label('Sesións')
									->relationship()
									->addActionAlignment(Alignment::Start)
									->addActionLabel('Añadir sesión')
									->schema(Schedule::getForm())
								])
						])
				])
		];
	}

	/**
	 * Spatie Media Library collections.
	 */
	public function registerMediaCollections(): void
	{
    $this->addMediaCollection('image')
			->singleFile()
			->useDisk('media')
			->acceptsMimeTypes(['image/jpeg', 'image/svg+xml', 'image/png', 'image/apng', 'image/jp2', 'image/gif', 'image/webp']);
	}

	/**
	 * Thumbnail media conversion for Spatie media library.
	 */
	public function registerMediaConversions(?Media $media = null): void
	{
		$this->addMediaConversion('image_opt')
			->fit(Fit::Contain, 1600, 1067)
			->quality(85)
			->format('webp')
			->withResponsiveImages();

		$this->addMediaConversion('admin_thumb')
			->fit(Fit::Crop, 192, 128)
			->quality(75)
			->format('webp')
			->nonQueued();
	}

}
