<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedPlace extends Model
{
    protected $fillable = [
        'destination_id',
        'name',
        'description',
        'address',
        'website',
        'category',
        'is_visited',
    ];

    protected function casts(): array
    {
        return [
            'is_visited' => 'boolean',
        ];
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}