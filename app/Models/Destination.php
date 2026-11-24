<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    protected $fillable = [
        'trip_id',
        'name',
        'country',
        'description',
        'arrival_date',
        'departure_date',
        'position',
    ];

    protected function casts(): array
    {
        return [
            'arrival_date' => 'date',
            'departure_date' => 'date',
        ];
    }

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function savedPlaces(): HasMany
    {
        return $this->hasMany(SavedPlace::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}