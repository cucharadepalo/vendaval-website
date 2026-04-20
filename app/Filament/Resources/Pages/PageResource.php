<?php

namespace App\Filament\Resources\Pages;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Actions\EditAction;
use App\Filament\Resources\Pages\Pages\ListPages;
use App\Filament\Resources\Pages\Pages\CreatePage;
use App\Filament\Resources\Pages\Pages\EditPage;
use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
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

	protected static string | \BackedEnum | null $navigationIcon = 'bx-layer';

	protected static string | \BackedEnum | null $activeNavigationIcon = 'bxs-layer';

	protected static ?string $navigationLabel = 'Páxinas';

	protected static ?string $modelLabel = 'Páxina';

	protected static ?int $navigationSort = 2;

	public static function form(Schema $schema): Schema
	{
		return $schema
			->components([
				Grid::make(5)
					->schema([
						TextInput::make('title')
							->translateLabel()
							->maxLength(191)
							->columnSpan(2),
						Hidden::make('type')
							->default('custom'),
						TextInput::make('slug')
							->label('Código / Slug')
							->maxLength(191)
							->columnSpan(1)
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
						MarkdownEditor::make('content')
							->translateLabel()
							->minHeight('30rem')
							->columnSpan(3)
							->fileAttachmentsDisk('media')
							->fileAttachmentsDirectory('paxinas')
							->disableToolbarButtons([
								'codeBlock'
							])
					])
			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('title')
					->size(TextSize::Large)
					->weight(FontWeight::Bold)
					->translateLabel(),
				TextColumn::make('slug')
					->label('Codigo / slug'),
				ToggleColumn::make('is_published')
					->label('Publicada')
					->disabled(fn (Page $record): bool => $record->type === 'system')
					->onColor(function (Page $record): string {
						if ($record->type === 'system') {
							return 'gray';
						} else {
							return 'success';
						}
					}),
				ToggleColumn::make('in_menu')
					->label('No menú')

			])
			->filters([
				//
			])
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
			'index' => ListPages::route('/'),
			'create' => CreatePage::route('/create'),
			'edit' => EditPage::route('/{record}/edit'),
		];
	}
}
