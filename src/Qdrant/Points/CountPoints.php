<?php

namespace Wontonee\LarQ\Qdrant\Points;

use Wontonee\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class CountPoints
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * Count points in a collection, with optional filters.
     *
     * @param string $collectionName
     * @param array|null $filter
     */
    public function handle(string $collectionName, ?array $filter = null): Response
    {
        $payload = ['exact' => true];

        if ($filter) {
            $payload['filter'] = $filter;
        }

        return $this->client->post("/collections/{$collectionName}/points/count", $payload);
    }
}