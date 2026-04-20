<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use App\Filament\Resources\FilmResource\Pages\ListFilms;
use App\Filament\Resources\FilmResource\Pages\CreateFilm;
use App\Filament\Resources\FilmResource\Pages\EditFilm;
use App\Filament\Resources\FilmResource\Pages;
use App\Models\Film;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Support\Enums\FontWeight;

class FilmResource extends Resource
{
	protected static ?string $model = Film::class;

	protected static string | \BackedEnum | null $navigationIcon = 'bx-movie';

	protected static string | \BackedEnum | null $activeNavigationIcon = 'bxs-movie';

	protected static ?string $navigationLabel = 'Filmes';

	protected static ?string $modelLabel = 'film';

	protected static ?int $navigationSort = 3;

	public static function form(Schema $schema): Schema
	{
		return $schema
			->components(Film::getForm());
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
					->size(TextSize::Large)
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
			->recordActions([
				EditAction::make(),
			])
			->toolbarActions([]);
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
			'index' => ListFilms::route('/'),
			'create' => CreateFilm::route('/create'),
			'edit' => EditFilm::route('/{record}/edit'),
		];
	}
}
