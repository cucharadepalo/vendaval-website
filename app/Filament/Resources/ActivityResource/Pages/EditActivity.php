<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditActivity extends EditRecord
{
	protected static string $resource = ActivityResource::class;

	protected function getHeaderActions(): array
	{
		return [
			Actions\DeleteAction::make(),
		];
	}

	/**
	 * Redirect to list after record edition
	 */
	public function getRedirectUrl(): string
	{
		return $this->getResource()::getUrl('index');
	}
}
