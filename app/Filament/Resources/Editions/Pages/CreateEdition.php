<?php

namespace App\Filament\Resources\Editions\Pages;

use App\Filament\Resources\Editions\EditionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEdition extends CreateRecord
{
	protected static string $resource = EditionResource::class;
}
