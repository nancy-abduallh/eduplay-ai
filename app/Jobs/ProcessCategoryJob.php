<?php

namespace App\Jobs;

use App\Models\Course;
use App\Models\FetchSession;
use App\Services\GeminiService ;
use App\Services\YouTubeService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessCategoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 120;
    public int $tries   = 2;

    public function __construct(
        public readonly int $sessionId,
        public readonly string $category
    ) {}

    public function handle(GeminiService  $openAI, YouTubeService $youtube): void
    {
        $session = FetchSession::find($this->sessionId);

        if (!$session) return;

        if ($session->status === 'pending') {
            $session->update(['status' => 'processing']);
        }

        $titles = $openAI->generateCourseTitles($this->category);
        \Illuminate\Support\Facades\Log::info('Titles for ' . $this->category, ['titles' => $titles]);

        $found = 0;

        foreach ($titles as $title) {
            if (empty(trim($title))) continue;

            $playlists = $youtube->searchPlaylists($title, 2);
            \Illuminate\Support\Facades\Log::info('YouTube search', ['title' => $title, 'playlists' => $playlists]);

            foreach ($playlists as $playlist) {
                if (Course::where('playlist_id', $playlist['playlist_id'])->exists()) continue;

                Course::create([
                    'playlist_id'      => $playlist['playlist_id'],
                    'title'            => $playlist['title'],
                    'description'      => $playlist['description'],
                    'thumbnail'        => $playlist['thumbnail'],
                    'channel_name'     => $playlist['channel_name'],
                    'category'         => $this->category,
                    'fetch_session_id' => $this->sessionId,
                ]);

                $found++;
            }

            usleep(200000);
        }

        $session->increment('processed_categories');
        $session->increment('total_found', $found);

        $fresh = $session->fresh();

        if ($fresh && $fresh->processed_categories >= $fresh->total_categories) {
            $fresh->update(['status' => 'completed']);
        }
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('ProcessCategoryJob failed', [
            'session'   => $this->sessionId,
            'category'  => $this->category,
            'error'     => $exception->getMessage(),
        ]);

        $session = FetchSession::find($this->sessionId);

        if (!$session) return;

        $session->increment('processed_categories');

        $fresh = $session->fresh();

        if ($fresh && $fresh->processed_categories >= $fresh->total_categories) {
            $fresh->update(['status' => 'completed']);
        }
    }
}
