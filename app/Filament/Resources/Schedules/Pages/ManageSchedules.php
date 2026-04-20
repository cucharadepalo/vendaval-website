<?php

namespace App\Filament\Resources\Schedules\Pages;

use App\Filament\Resources\Schedules\ScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSchedules extends ManageRecords
{
	protected static string $resource = ScheduleResource::class;

	protected static ?string $title = 'Programa';

	protected function getHeaderActions(): array
	{
		return [
			// Actions\CreateAction::make(),
		];
	}
}
