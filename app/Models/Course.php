<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    protected $fillable = [
        'playlist_id',
        'title',
        'description',
        'thumbnail',
        'channel_name',
        'category',
        'fetch_session_id',
    ];

    public function fetchSession(): BelongsTo
    {
        return $this->belongsTo(FetchSession::class);
    }

    public function getYoutubeUrlAttribute(): string
    {
        return 'https://www.youtube.com/playlist?list=' . $this->playlist_id;
    }

    public function getThumbnailUrlAttribute(): string
    {
        return $this->thumbnail ?: 'https://via.placeholder.com/480x360/1D1919/C41C1C?text=No+Thumbnail';
    }
}
