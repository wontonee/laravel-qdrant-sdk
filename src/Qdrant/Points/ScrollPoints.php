<?php

namespace Wontonee\LarQ\Qdrant\Points;

use Wontonee\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class ScrollPoints
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * Scroll through points with optional filters, limit, and offset.
     *
     * @param string $collectionName
     * @param int $limit
     * @param array|null $filter
     * @param array|null $offset     // e.g., ['point_id' => '123']
     */
    public function handle(string $collectionName, int $limit = 10, ?array $filter = null, ?array $offset = null): Response
    {
        $payload = ['limit' => $limit];

        if ($filter) {
            $payload['filter'] = $filter;
        }

        if ($offset) {
            $payload['offset'] = $offset;
        }

        return $this->client->post("/collections/{$collectionName}/points/scroll", $payload);
    }
}