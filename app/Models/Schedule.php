<?php

namespace App\Models;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Schedule extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'start_time',
		'description',
		'notes',
		'schedulable_id',
		'schedulable_type',
		'venue_id',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'start_time' => 'datetime',
		'schedulable_id' => 'integer',
		'venue_id' => 'integer',
	];

	/**
	 * Get the parent Venue model
	 *
	 */
	public function venue(): BelongsTo
	{
		return $this->belongsTo(Venue::class);
	}

	/**
	 * Get all the films with this schedule.
	 */
	public function films(): MorphToMany
	{
		return $this->morphedByMany(Film::class, 'schedulable');
	}

	/**
	 * Get all the films with this schedule.
	 */
	public function activities(): MorphToMany
	{
		return $this->morphedByMany(Activity::class, 'schedulable');
	}

	/**
	 * Get the filament form CRUD configuration.
	 *
	 */
	public static function getForm(): array
	{
		return [
			DateTimePicker::make('start_time')
				->label('Data')
				->native(false)
				->seconds(false)
				->minutesStep(15)
				// ->minDate(now())
				->displayFormat('j / F / Y — H:i')
				->locale('es')
				->required(),
			Select::make('venue_id')
				->relationship(name: 'venue', titleAttribute: 'name')
				->label('Lugar')
				->required(),
			TextInput::make('description')
				->translateLabel()
				->maxLength(191)
				->helperText('Ex: "Cinema" ou "Música"'),
			TextInput::make('notes')
				->translateLabel()
				->maxLength(255)
				->helperText('Ex: Presentado por...'),
		];
	}
}
