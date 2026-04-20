<?php

namespace App\Filament\Resources\FilmResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\FilmResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFilms extends ListRecords
{
	protected static string $resource = FilmResource::class;

	protected function getHeaderActions(): array
	{
		return [
			CreateAction::make(),
		];
	}
}
