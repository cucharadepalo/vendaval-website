<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Models\Activity;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Support\Enums\FontWeight;

class ActivityResource extends Resource
{
	protected static ?string $model = Activity::class;

	protected static ?string $navigationIcon = 'bx-music';

	protected static ?string $activeNavigationIcon = 'bxs-music';

	protected static ?string $navigationLabel = 'Actividades';

	protected static ?string $modelLabel = 'actividad';

	protected static ?string $pluralModelLabel = 'actividades';

	protected static ?int $navigationSort = 3;

	public static function form(Form $form): Form
	{
		return $form
			->schema(Activity::getForm());
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				SpatieMediaLibraryImageColumn::make('image')
					->width(96)
					->height(64)
					->collection('image')
					->conversion('preview')
					->translateLabel(),
				TextColumn::make('title')
					->size(TextColumn\TextColumnSize::Large)
					->weight(FontWeight::Bold)
					->description(fn(Activity $item): string => $item->summary)
					->translateLabel(),
				TextColumn::make('editions.name')
					->label('Edicion(s')
					->listWithLineBreaks()
					->badge(),
				TextColumn::make('schedules.start_time')
					->listWithLineBreaks()
					->dateTime('j / F / Y — H:i')
					->translateLabel(),
			])
			->filters([
				SelectFilter::make('editions')
					->label('Edicións')
					->relationship('editions', 'name')
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
			'index' => Pages\ListActivities::route('/'),
			'create' => Pages\CreateActivity::route('/create'),
			'edit' => Pages\EditActivity::route('/{record}/edit'),
		];
	}
}
