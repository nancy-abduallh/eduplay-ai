<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

    public function generateCourseTitles(string $category): array
    {
        // Try Gemini API first
        $titles = $this->callGemini($category);

        // If API fails or returns empty, fallback to static queries
        if (empty($titles)) {
            Log::warning('Falling back to static queries for category: ' . $category);
            $titles = $this->getStaticQueries($category);
        }

        return $titles;
    }

    protected function callGemini(string $category): array
    {
        if (empty($this->apiKey)) {
            Log::error('Gemini API key is missing');
            return [];
        }

        $prompt = "Generate exactly 15 specific YouTube playlist search queries for learning {$category}. Each query should be unique, varied, and likely to find a real educational playlist. Return ONLY the queries, one per line, with no numbering, no dashes, no extra text.";

        // Use gemini-1.0-pro model (widely available)
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.0-pro:generateContent?key=' . $this->apiKey;

        $response = Http::timeout(30)->post($url, [
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ]
        ]);

        Log::info('Gemini API response', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        if ($response->failed()) {
            Log::error('Gemini API failed', ['status' => $response->status(), 'body' => $response->body()]);
            return [];
        }

        $content = $response->json('candidates.0.content.parts.0.text', '');
        $lines = array_filter(array_map('trim', explode("\n", $content)));
        $lines = array_values($lines);

        Log::info('Gemini generated titles', ['titles' => $lines]);

        return $lines;
    }

    protected function getStaticQueries(string $category): array
    {
        return [
            "learn {$category} full course",
            "{$category} tutorial for beginners",
            "complete {$category} training",
            "{$category} crash course",
            "best {$category} course",
            "advanced {$category} concepts",
            "{$category} for professionals",
            "{$category} step by step",
            "{$category} with projects",
            "{$category} certification",
            "{$category} masterclass",
            "{$category} essentials",
            "{$category} from scratch",
            "{$category} fundamentals",
            "{$category} 2025",
        ];
    }
}
