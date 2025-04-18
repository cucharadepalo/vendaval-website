<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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
     * Get the parent schedulable model (Film or activity).
     */
    public function schedulable(): MorphTo
    {
        return $this->morphTo();
    }
}
