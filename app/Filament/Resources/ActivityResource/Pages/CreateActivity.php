<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateActivity extends CreateRecord
{
	protected static string $resource = ActivityResource::class;

	/**
	 * Redirect to list after record creation
	 *
	 */
	protected function getRedirectUrl(): string
	{
		return $this->getResource()::getUrl('index');
	}
}
