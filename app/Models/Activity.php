<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Support\Enums\Alignment;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
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
		'summary',
		'text',
	];

	/**
	 * Get all of the activity's schedules.
	 */
	public function schedules(): MorphMany
	{
		return $this->morphMany(Schedule::class, 'schedulable');
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
								->maxLength(191)
								->translateLabel()
								->columnSpanFull(),
							Textarea::make('summary')
								->required()
								->maxLength(255)
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
										->conversion('preview')
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
	 * Thumbnail media conversion for Spatie media library.
	 */
	public function registerMediaConversions(?Media $media = null): void
	{
		$this->addMediaConversion('preview')
			->fit(Fit::Contain, 300, 300)
			->nonQueued();
	}

	/**
	 * Spatie Media Library collections.
	 */
	public function registerMediaCollections(): void
	{
    $this->addMediaCollection('image')
			->singleFile()
			->acceptsMimeTypes(['image/jpeg', 'image/svg+xml', 'image/png', 'image/apng', 'image/jp2', 'image/gif', 'image/webp']);
	}
}
