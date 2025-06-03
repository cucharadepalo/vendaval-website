<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PageResource extends Resource
{
	protected static ?string $model = Page::class;

	protected static ?string $navigationIcon = 'bx-layer';

	protected static ?string $activeNavigationIcon = 'bxs-layer';

	protected static ?string $navigationLabel = 'Páxinas';

	protected static ?string $modelLabel = 'Páxina';

	protected static ?int $navigationSort = 2;

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\Grid::make(5)
					->schema([
						Forms\Components\TextInput::make('title')
							->translateLabel()
							->maxLength(191)
							->columnSpan(2),
						Forms\Components\TextInput::make('slug')
							->label('Código / Slug')
							->maxLength(191)
							->readOnly(fn (Page $record): bool => $record->type === 'system')
							->afterStateUpdated(function (?string $state): string {
								return Str::slug($state);
							})
							->helperText(function (Page $record): string {
								if ($record->type === 'system') {
									return 'No modificable';
								} else {
									return 'A url da páxina';
								}
							}),
						Forms\Components\Toggle::make('is_published')
							->label('Publicada')
							->disabled(fn (Page $record): bool => $record->type === 'system')

					])
			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('title')
					->size(TextColumn\TextColumnSize::Large)
					->weight(FontWeight::Bold)
					->translateLabel(),
				TextColumn::make('slug')
					->label('Codigo / slug')
			])
			->filters([
				//
			])
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
			'index' => Pages\ListPages::route('/'),
			'create' => Pages\CreatePage::route('/create'),
			'edit' => Pages\EditPage::route('/{record}/edit'),
		];
	}
}
