<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
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
	public function edition(): BelongsTo
	{
		return $this->belongsTo(Edition::class);
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
						->schema([
							TextInput::make('title')
								->required()
								->maxLength(191)
								->translateLabel(),
							Textarea::make('summary')
								->required()
								->maxLength(255)
								->translateLabel(),
							MarkdownEditor::make('text')
								->disableToolbarButtons([
									'attachFiles',
									'codeBlock',
									'strike'
								])
								->minHeight('20rem')
								->translateLabel(),
						]),
					Section::make()
						->columnSpan(2)
						->schema([
							SpatieMediaLibraryFileUpload::make('image')
								->conversion('preview')
								->translateLabel(),
							Repeater::make('schedules')
								->label('Sesións')
								->relationship()
								->schema(Schedule::getForm())
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
