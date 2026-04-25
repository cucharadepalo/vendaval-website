<?php

namespace App\Filament\Resources\Editions\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Editions\EditionResource;
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
