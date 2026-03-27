<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FetchSession extends Model
{
    protected $fillable = [
        'status',
        'categories',
        'total_categories',
        'processed_categories',
        'total_found',
    ];

    protected $casts = [
        'categories' => 'array',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function getPercentageAttribute(): int
    {
        if ($this->total_categories === 0) return 0;
        return (int) round(($this->processed_categories / $this->total_categories) * 100);
    }
}
