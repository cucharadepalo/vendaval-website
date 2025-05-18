<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VenueResource\Pages;
use App\Models\Venue;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VenueResource extends Resource
{
	protected static ?string $model = Venue::class;

	protected static ?string $navigationIcon = 'bx-buildings';

	protected static ?string $activeNavigationIcon = 'bxs-buildings';

	protected static ?string $navigationLabel = 'Lugares';

	protected static ?string $modelLabel = 'lugar';

	protected static ?string $pluralModelLabel = 'lugares';

	protected static ?int $navigationSort = 4;

	public static function form(Form $form): Form
	{
		return $form
			->schema(Venue::getForm());
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('name')
					->size(TextColumn\TextColumnSize::Large)
					->weight(FontWeight::Bold)
					->translateLabel(),
				TextColumn::make('town')
					->translateLabel(),
				IconColumn::make('map')
					->icon('bx-map')
					->color('primary')
					->url(fn(Venue $record): string|null => $record->map)
					->openUrlInNewTab()
					->translateLabel(),
				IconColumn::make('has_page')
					->icon('bx-check-circle')
					->color('primary')
					->Label('Páxina propia'),
			])
			->filters([
				//
			])
			->actions([
				Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make(),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			]);
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ListVenues::route('/'),
			'create' => Pages\CreateVenue::route('/create'),
			'edit' => Pages\EditVenue::route('/{record}/edit')
		];
	}
}
