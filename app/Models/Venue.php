<?php

namespace App\Models;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venue extends Model
{
	protected $fillable = [
		'name',
		'town',
		'map',
		'text',
		'website',
		'address',
	];

	/**
	 * Get all of the Venue's schedules.
	 */
	public function schedules(): HasMany
	{
		return $this->hasMany(Schedule::class);
	}

	/**
	 * Get the filament form CRUD configuration.
	 */
	public static function getForm(): array
	{
		return [
			Section::make('Datos')
				->columnSpanFull()
				->columns(3)
				->schema([
					TextInput::make('name')
						->required()
						->maxLength(191)
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
						->columnSpan(2)
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
					MarkdownEditor::make('text')
						->disableToolbarButtons([
							'blockquote',
							'codeBlock',
							'strike',
							'table',
							'headings'
						])
						->fileAttachmentsDisk('media')
						->fileAttachmentsDirectory('venues')
						->label('Texto')
						->columnSpanFull()
				])
		];
	}
}
