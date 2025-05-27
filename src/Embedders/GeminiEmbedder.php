<?php

namespace Wontonee\LarQ\Embedders;

use Illuminate\Support\Facades\Http;
use Wontonee\LarQ\Contracts\EmbedderInterface;

class GeminiEmbedder implements EmbedderInterface
{
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('larq.gemini_api_key');
        $this->model = config('larq.gemini_model', 'models/embedding-001');
    }

    public function embed(string $text): array
    {
        $response = Http::withToken($this->apiKey)
            ->acceptJson()
            ->post("https://generativelanguage.googleapis.com/v1beta2/{$this->model}:embedText", [
                'text' => $text,
            ]);

        if (! $response->successful()) {
            throw new \RuntimeException('Gemini embedding failed: ' . $response->body());
        }

        return $response->json('embedding.value') ?? [];
    }
}