<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class YouTubeService
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.youtube.key');
    }

    public function searchPlaylists(string $query, int $limit = 2): array
    {
        $response = Http::timeout(15)->get('https://www.googleapis.com/youtube/v3/search', [
            'part'       => 'snippet',
            'q'          => $query,
            'type'       => 'playlist',
            'maxResults' => $limit,
            'key'        => $this->apiKey,
        ]);

        if ($response->failed()) {
            Log::error('YouTube API failed', ['query' => $query, 'status' => $response->status()]);
            return [];
        }

        $items     = $response->json('items', []);
        $playlists = [];

        foreach ($items as $item) {
            $playlistId = $item['id']['playlistId'] ?? null;
            if (!$playlistId) continue;

            $thumbnails = $item['snippet']['thumbnails'] ?? [];
            $thumbnail  = $thumbnails['high']['url']
                ?? $thumbnails['medium']['url']
                ?? $thumbnails['default']['url']
                ?? '';

            $playlists[] = [
                'playlist_id'  => $playlistId,
                'title'        => $item['snippet']['title'] ?? 'Untitled Playlist',
                'description'  => mb_substr($item['snippet']['description'] ?? '', 0, 600),
                'thumbnail'    => $thumbnail,
                'channel_name' => $item['snippet']['channelTitle'] ?? 'Unknown Channel',
            ];
        }

        return $playlists;
    }
}
