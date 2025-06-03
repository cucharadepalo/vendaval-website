<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FilmResource\Pages;
use App\Models\Film;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\Action;

class FilmResource extends Resource
{
	protected static ?string $model = Film::class;

	protected static ?string $navigationIcon = 'bx-movie';

	protected static ?string $activeNavigationIcon = 'bxs-movie';

	protected static ?string $navigationLabel = 'Filmes';

	protected static ?string $modelLabel = 'film';

	protected static ?int $navigationSort = 3;

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
					->collection('poster')
					->conversion('poster_thumbnail')
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
				TextColumn::make('editions.name')
					->label('Edición(s)')
					->listWithLineBreaks()
    			->badge(),
				TextColumn::make('schedules.start_time')
					->listWithLineBreaks()
					->dateTime('j / F / Y — H:i')
					->label('Proxeccións'),
			])
			->filters([
				SelectFilter::make('editions')
					->label('Edicións')
					->placeholder('Todas')
					->relationship('editions', 'name')
			])
			->persistFiltersInSession()
			->filtersTriggerAction( function (Action $action) {
				return $action->button()->label('Filtros');
			})
			->actions([
				Tables\Actions\EditAction::make(),
			])
			->bulkActions([]);
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
