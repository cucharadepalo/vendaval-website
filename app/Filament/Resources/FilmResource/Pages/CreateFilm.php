<?php

namespace App\Filament\Resources\FilmResource\Pages;

use App\Filament\Resources\FilmResource;
use App\Models\Edition;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateFilm extends CreateRecord
{
	protected static string $resource = FilmResource::class;

	/**
	 * Transform the duration column from minutes to 'hh:mm' format
	 */
	protected function mutateFormDataBeforeCreate(array $data): array
	{
		$data['duration'] = convertToHoursMins($data['duration']);

		return $data;
	}

	/**
	 * Redirect to list after record creation
	 */
	protected function getRedirectUrl(): string
	{
		return $this->getResource()::getUrl('index');
	}

	/**
	 * Assign active edition to new Films
	 */
	protected function handleRecordCreation(array $data): Model
	{
		$active_edition = Edition::active()->first();
		$data['edition_id'] = $active_edition ? $active_edition->id : null;

		return static::getModel()::create($data);
	}
}
