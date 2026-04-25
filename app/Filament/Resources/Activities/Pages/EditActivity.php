<?php

namespace App\Filament\Resources\Activities\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\Activities\ActivityResource;
use Filament\Resources\Pages\EditRecord;

class EditActivity extends EditRecord
{
	protected static string $resource = ActivityResource::class;

	protected function getHeaderActions(): array
	{
		return [
			DeleteAction::make(),
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
