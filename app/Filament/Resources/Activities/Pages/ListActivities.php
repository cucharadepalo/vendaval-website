<?php

namespace App\Filament\Resources\Activities\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Activities\ActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActivities extends ListRecords
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
