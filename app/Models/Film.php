<?php

namespace App\Models;

use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Film extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'director',
        'year',
        'genre',
        'language',
        'version',
        'duration',
        'text',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'event' => 'boolean',
    ];

    /**
     * Get all of the film's schedules.
     *
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
                        ->columns(2)
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->maxLength(191)
                                ->columnSpanFull()
                                ->translateLabel(),
                            TextInput::make('director')
                                ->required()
                                ->maxLength(191)
                                ->translateLabel(),
                            TextInput::make('year')
                                ->numeric()
                                ->minValue(1900)
                                ->maxValue(2100)
                                ->placeholder(2000)
                                ->translateLabel(),
                            TextInput::make('genre')
                                ->maxLength(191)
                                ->helperText('Ex: Documentario o Ficción... ')
                                ->translateLabel(),
                            TextInput::make('duration')
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(600)
                                ->suffix('Minutos')
                                ->translateLabel(),
                            TextInput::make('language')
                                ->maxLength(191)
                                ->placeholder('PT')
                                ->translateLabel(),
                            TextInput::make('version')
                                ->maxLength(191)
                                ->helperText('Ex: Versión orixinal con subtítulos en...')
                                ->translateLabel(),
                            MarkdownEditor::make('text')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                    'codeBlock',
                                    'strike',
                                ])
                                ->minHeight('24rem')
                                ->columnSpanFull()
                                ->translateLabel(),
                        ]),
                    Section::make()
                        ->columnSpan(2)
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('poster')
                                ->conversion('preview'),
                            SpatieMediaLibraryFileUpload::make('still')
                                ->collection('stills')
                                ->multiple()
                                ->conversion('preview'),
                            Repeater::make('schedules')
                                ->label('Proxeccións')
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
                                        ->helperText('Ex: "Cinema" ou "Cinema ao aire libre"'),
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
