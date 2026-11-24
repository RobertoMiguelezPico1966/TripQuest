<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackingItem extends Model
{
    protected $fillable = [
        'trip_id',
        'name',
        'category',
        'quantity',
        'is_packed',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'is_packed' => 'boolean',
        ];
    }

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }
}