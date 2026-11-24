<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    protected $fillable = [
        'destination_id',
        'name',
        'description',
        'activity_date',
        'start_time',
        'end_time',
        'location',
        'category',
        'position',
    ];

    protected function casts(): array
    {
        return [
            'activity_date' => 'date',
        ];
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}