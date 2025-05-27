<?php

namespace Wontonee\LarQ\Qdrant;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class Client
{
    protected string $host;
    protected ?string $apiKey;

    public function __construct()
    {
        $this->host = config('larq.host', 'http://localhost:6333');
        $this->apiKey = config('larq.api_key');
    }

    protected function baseRequest(): \Illuminate\Http\Client\PendingRequest
    {
        $request = Http::acceptJson()->baseUrl($this->host);

        if ($this->apiKey) {
            $request->withHeaders(['api-key' => $this->apiKey]);
        }

        return $request;
    }

    public function get(string $uri, array $query = []): Response
    {
        return $this->baseRequest()->get($uri, $query);
    }

    public function post(string $uri, array $data = []): Response
    {
        return $this->baseRequest()->post($uri, $data);
    }

    public function put(string $uri, array $data = []): Response
    {
        return $this->baseRequest()->put($uri, $data);
    }

    public function delete(string $uri): Response
    {
        return $this->baseRequest()->delete($uri);
    }
}