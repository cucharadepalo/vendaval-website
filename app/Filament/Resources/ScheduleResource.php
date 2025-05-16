<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Filament\Resources\ScheduleResource\RelationManagers;
use App\Models\Schedule;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduleResource extends Resource
{
	protected static ?string $model = Schedule::class;

	protected static ?string $navigationIcon = 'bx-calendar-alt';

	protected static ?string $activeNavigationIcon = 'bxs-calendar-alt';

	protected static ?string $navigationLabel = 'Programa';

	protected static ?string $modelLabel = 'sesión';

	protected static ?string $pluralModelLabel = 'sesiones';

	protected static ?int $navigationSort = 5;

	public static function form(Form $form): Form
	{
		return $form
			->schema(Schedule::getForm());
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('venue.name')
					->sortable()
					->translateLabel(),
				TextColumn::make('start_time')
					->sortable()
					->label('Data')
					->dateTime('j / F / Y — H:i'),
				TextColumn::make('description')
					->translateLabel(),
				TextColumn::make('schedulable.title')
					->label('Película / Actividade'),
			])
			->defaultSort('start_time', 'asc')
			->filters([
				//
			])
			->actions([
				Tables\Actions\EditAction::make()
					->slideOver(),
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
			'index' => Pages\ManageSchedules::route('/'),
		];
	}
}
