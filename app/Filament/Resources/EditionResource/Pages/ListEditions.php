<?php

namespace App\Filament\Resources\EditionResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\EditionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEditions extends ListRecords
{
	protected static string $resource = EditionResource::class;

	protected function getHeaderActions(): array
	{
		return [
			CreateAction::make(),
		];
	}
}
