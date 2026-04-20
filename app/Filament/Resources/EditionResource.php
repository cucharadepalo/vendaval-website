<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;
use Filament\Actions\EditAction;
use App\Filament\Resources\EditionResource\Pages\ListEditions;
use App\Filament\Resources\EditionResource\Pages\CreateEdition;
use App\Filament\Resources\EditionResource\Pages\EditEdition;
use App\Filament\Resources\EditionResource\Pages;
use App\Filament\Resources\EditionResource\RelationManagers;
use App\Models\Edition;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class EditionResource extends Resource
{
	protected static ?string $model = Edition::class;

	protected static string | \BackedEnum | null $navigationIcon = 'bx-play-circle';

	protected static string | \BackedEnum | null $activeNavigationIcon = 'bxs-caret-right-circle';

	protected static ?string $navigationLabel = 'Edicións';

	protected static ?string $modelLabel = 'Edición';

	protected static ?int $navigationSort = 1;

	public static function form(Schema $schema): Schema
	{
		return $schema
			->components(Edition::getForm());
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				SpatieMediaLibraryImageColumn::make('splash')
					->collection('splash')
					->filterMediaUsing(
						fn(Collection $media): Collection => $media->where(
							'custom_properties.version', 'landscape'
						)
					)
					->conversion('thumb')
					->width(150)
					->height(100)
					->label('Deseño'),
				TextColumn::make('name')
					->size(TextSize::Large)
					->weight(FontWeight::Bold)
					->translateLabel(),
				TextColumn::make('title')
					->translateLabel(),
				ToggleColumn::make('is_active')
					->label('Activa')
					->beforeStateUpdated(function (Edition $record, bool $state) {
						if ($state) {
							Edition::where('id', '!=', $record->id)->update(['is_active' => false]);
						} else {
							Notification::make()
								->title('Desactivaches todas as edicións.')
								->icon('bx-error')
								->body('Lembra activar outra para que a páxina sexa funcional.')
								->color('warning')
								->persistent()
								->send();
						}
					})
			])
			->filters([
				//
			])
			->recordActions([
				EditAction::make(),
			])
			->toolbarActions([
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
			'index' => ListEditions::route('/'),
			'create' => CreateEdition::route('/create'),
			'edit' => EditEdition::route('/{record}/edit'),
		];
	}
}
