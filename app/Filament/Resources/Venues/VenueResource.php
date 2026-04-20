<?php

namespace App\Filament\Resources\Venues;

use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\Venues\Pages\ListVenues;
use App\Filament\Resources\Venues\Pages\CreateVenue;
use App\Filament\Resources\Venues\Pages\EditVenue;
use App\Filament\Resources\VenueResource\Pages;
use App\Models\Venue;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VenueResource extends Resource
{
	protected static ?string $model = Venue::class;

	protected static string | \BackedEnum | null $navigationIcon = 'bx-buildings';

	protected static string | \BackedEnum | null $activeNavigationIcon = 'bxs-buildings';

	protected static ?string $navigationLabel = 'Lugares';

	protected static ?string $modelLabel = 'lugar';

	protected static ?string $pluralModelLabel = 'lugares';

	protected static ?int $navigationSort = 6;

	public static function form(Schema $schema): Schema
	{
		return $schema
			->components(Venue::getForm());
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('name')
					->size(TextSize::Large)
					->weight(FontWeight::Bold)
					->translateLabel(),
				TextColumn::make('town')
					->translateLabel(),
				IconColumn::make('map')
					->icon('bx-map')
					->color('primary')
					->url(fn(Venue $record): string|null => $record->map)
					->openUrlInNewTab()
					->translateLabel()
			])
			->filters([
				//
			])
			->recordActions([
				EditAction::make(),
				DeleteAction::make(),
			])
			->toolbarActions([]);
	}

	public static function getPages(): array
	{
		return [
			'index' => ListVenues::route('/'),
			'create' => CreateVenue::route('/create'),
			'edit' => EditVenue::route('/{record}/edit')
		];
	}
}
