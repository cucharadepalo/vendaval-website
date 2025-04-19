<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Activity extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'summary',
        'text',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * Get all of the activity's schedules.
     */
    public function schedules(): MorphMany
    {
        return $this->morphMany(Schedule::class, 'schedulable');
    }

    /**
     * Generate thumbnail media conversion for Spatie media library.
     *
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    /**
     * Get the filament form CRUD configuration.
     *
     */
    public static function getForm(): array
    {
        return [
            Grid::make(5)
                ->schema([
                    Section::make()
                        ->columnSpan(3)
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->maxLength(191)
                                ->translateLabel(),
                            Textarea::make('summary')
                                ->required()
                                ->maxLength(255)
                                ->translateLabel(),
                            MarkdownEditor::make('text')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                    'codeBlock',
                                    'strike'
                                ])
                                ->minHeight('20rem')
                                ->translateLabel(),
                        ]),
                    Section::make()
                        ->columnSpan(2)
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('image')
                                ->conversion('preview')
                                ->translateLabel(),
                            Repeater::make('schedules')
                                ->label('Sesións')
                                ->relationship()
                                ->schema([
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
                                        ->helperText('Ex: "Música" ou "Obradoiro"'),
                                    TextInput::make('notes')
                                        ->translateLabel()
                                        ->maxLength(255)
                                        ->helperText('Ex: Presentado por...'),
                                ])
                        ])
                ])
        ];
    }
}
