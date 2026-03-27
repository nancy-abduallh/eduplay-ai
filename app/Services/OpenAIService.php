<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openai.key');
    }

    public function generateCourseTitles(string $category): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type'  => 'application/json',
        ])->timeout(30)->post('https://api.openai.com/v1/chat/completions', [
            'model'    => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role'    => 'system',
                    'content' => 'You are an expert educational content curator. Your job is to generate precise YouTube playlist search queries that would find high-quality educational courses.',
                ],
                [
                    'role'    => 'user',
                    'content' => "Generate exactly 15 specific YouTube playlist search queries for learning {$category}. Each query should be unique, varied, and likely to find a real educational playlist. Return ONLY the queries, one per line, with no numbering, no dashes, no extra text or explanation.",
                ],
            ],
            'max_tokens'  => 600,
            'temperature' => 0.8,
        ]);

        if ($response->failed()) {
            Log::error('OpenAI API failed', ['status' => $response->status(), 'body' => $response->body()]);
            return [];
        }

        $content = $response->json('choices.0.message.content', '');
        $lines   = array_filter(array_map('trim', explode("\n", $content)));

        return array_values($lines);
    }
}
