<?php

namespace App\Filament\Resources\FilmResource\Pages;

use App\Filament\Resources\FilmResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFilm extends EditRecord
{
	protected static string $resource = FilmResource::class;

	protected function getHeaderActions(): array
	{
		return [
			Actions\DeleteAction::make(),
		];
	}

	/**
	 * Customize data before filling the form
	 *
	 */
	protected function mutateFormDataBeforeFill(array $data): array
	{
		if ($data['duration']) {
			$data['duration'] = convertToMinutes($data['duration']);
		}

		return $data;
	}

	/**
	 * Transform the duration column from minutes to 'hh:mm' format
	 *
	 */
	protected function mutateFormDataBeforeSave(array $data): array
	{
		if ($data['duration']) {
			$data['duration'] = convertToHoursMinsSecs($data['duration']);
		}

		return $data;
	}

	/**
	 * Redirect to list after record edition
	 */
	public function getRedirectUrl(): string
	{
		return $this->getResource()::getUrl('index');
	}
}
