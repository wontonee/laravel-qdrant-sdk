<?php

namespace Wontonee\LarQ\Embedders;

use Illuminate\Support\Facades\Http;
use Wontonee\LarQ\Contracts\EmbedderInterface;

class OpenAIEmbedder implements EmbedderInterface
{
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('larq.openai_api_key');
        $this->model = config('larq.openai_model', 'text-embedding-ada-002');
    }

    public function embed(string $text): array
    {
        $response = Http::withToken($this->apiKey)
            ->acceptJson()
            ->post('https://api.openai.com/v1/embeddings', [
                'model' => $this->model,
                'input' => $text,
            ]);

        if (! $response->successful()) {
            throw new \RuntimeException('OpenAI embedding failed: ' . $response->body());
        }

        return $response->json('data.0.embedding') ?? [];
    }
}
