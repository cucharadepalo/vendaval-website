<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FilmResource\Pages;
use App\Filament\Resources\FilmResource\RelationManagers;
use App\Models\Film;
use App\Models\Schedule;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Support\Enums\FontWeight;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FilmResource extends Resource
{
	protected static ?string $model = Film::class;

	protected static ?string $navigationIcon = 'bx-movie';

	protected static ?string $activeNavigationIcon = 'bxs-movie';

	protected static ?string $navigationLabel = 'Películas';

	protected static ?string $modelLabel = 'película';

	protected static ?int $navigationSort = 1;

	public static function form(Form $form): Form
	{
		return $form
			->schema(Film::getForm());
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				SpatieMediaLibraryImageColumn::make('poster')
					->conversion('preview')
					->height(64)
					->width(43)
					->translateLabel(),
				TextColumn::make('title')
					->size(TextColumn\TextColumnSize::Large)
					->weight(FontWeight::Bold)
					->translateLabel(),
				TextColumn::make('director')
					->translateLabel(),
				TextColumn::make('year')
					->translateLabel(),
				TextColumn::make('schedules.start_time')
					->listWithLineBreaks()
					->dateTime('j / F / Y — H:i')
					->label('Proxeccións'),
			])
			->filters([
				//
			])
			->actions([
				Tables\Actions\EditAction::make(),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			]);
	}

	public static function getRelations(): array
	{
		return [
			//
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ListFilms::route('/'),
			'create' => Pages\CreateFilm::route('/create'),
			'edit' => Pages\EditFilm::route('/{record}/edit'),
		];
	}
}
