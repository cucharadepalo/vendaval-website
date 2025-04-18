<?php

namespace App\Filament\Resources\FilmResource\Pages;

use App\Filament\Resources\FilmResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFilm extends CreateRecord
{
    protected static string $resource = FilmResource::class;

    /**
     * Transform the duration column from minutes to 'hh:mm' format
     *
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['duration'] = convertToHoursMins($data['duration']);

        return $data;
    }

    /**
     * Redirect to list after record creation
     *
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
