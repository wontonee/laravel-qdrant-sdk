<?php

namespace Wontonee\LarQ\Qdrant\Points;

use Wontonee\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class RecommendPoints
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * Recommend points based on positive and/or negative example IDs.
     *
     * @param string $collectionName
     * @param array $positive          // List of point IDs
     * @param array $negative          // Optional list of point IDs
     * @param int $top                 // Number of recommendations
     * @param array|null $filter       // Optional filter
     */
    public function handle(string $collectionName, array $positive, array $negative = [], int $top = 10, ?array $filter = null): Response
    {
        $payload = [
            'positive' => $positive,
            'top' => $top,
        ];

        if (!empty($negative)) {
            $payload['negative'] = $negative;
        }

        if ($filter) {
            $payload['filter'] = $filter;
        }

        return $this->client->post("/collections/{$collectionName}/points/recommend", $payload);
    }
}