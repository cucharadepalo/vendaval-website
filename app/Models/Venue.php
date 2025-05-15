<?php

namespace App\Models;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venue extends Model
{
	use HasFactory;

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
		'address'
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
			TextInput::make('name')
				->required()
				->maxLength(191)
				->columnSpanFull()
				->translateLabel(),
			TextInput::make('town')
				->required()
				->maxLength(191)
				->columnSpanFull()
				->translateLabel(),
			TextInput::make('address')
				->maxLength(191)
				->columnSpanFull()
				->prefixIcon('bx-map-alt')
				->translateLabel(),
			TextInput::make('map')
				->maxLength(255)
				->url()
				->prefixIcon('bx-map')
				->placeholder('https://www.google.com/maps/place/...')
				->columnSpanFull()
				->translateLabel(),
			TextInput::make('website')
				->maxLength(255)
				->url()
				->prefixIcon('bx-link-alt')
				->placeholder('https://')
				->columnSpanFull()
				->translateLabel(),
			MarkdownEditor::make('text')
				->disableToolbarButtons([
					'attachFiles',
					'heading',
					'blockquote',
					'codeBlock',
					'strike',
					'table'
				])
				->translateLabel()
				->columnSpanFull()
				->helperText('Texto que se mostrará en la propia página del lugar.')
		];
	}
}
