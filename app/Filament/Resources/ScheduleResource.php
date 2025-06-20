<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Models\Schedule;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;

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
				TextColumn::make('start_time')
					->sortable()
					->label('Data')
					->dateTime('j/m/Y H:i'),
				TextColumn::make('description')
					->translateLabel()
					->weight(FontWeight::Bold),
				TextColumn::make('films.title')
					->limit(24)
					->label('Película(s)')
					->listWithLineBreaks(),
				TextColumn::make('activities.title')
					->limit(24)
					->label('Actividade(s)')
					->listWithLineBreaks(),
				TextColumn::make('venue.name')
					->sortable()
					->translateLabel(),
			])
			->defaultSort('start_time', 'asc')
			->filters([
				//
			])
			->actions([
				Tables\Actions\EditAction::make()
					->form([
						Section::make()
							->schema(Schedule::getForm())
							->columns(2),
						Section::make()
							->schema([
								Select::make('films')
									->label('Filmes')
									->relationship(name: 'films', titleAttribute: 'title')
									->multiple()
									->preload(),
								Select::make('activities')
									->label('Actividades')
									->relationship(name: 'activities', titleAttribute: 'title')
									->multiple()
									->preload()
							])
						->columns(2)

					])
					->slideOver(),
				Tables\Actions\DeleteAction::make(),
			])
			->bulkActions([]);
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ManageSchedules::route('/'),
		];
	}
}
