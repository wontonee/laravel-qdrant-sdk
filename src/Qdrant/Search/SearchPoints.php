<?php

namespace Wontonee\LarQ\Qdrant\Search;

use Wontonee\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class SearchPoints
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * Perform a similarity search on a collection.
     *
     * @param string $collectionName
     * @param array $vector            // The query vector
     * @param int $top                 // Number of results to return
     * @param array|null $filter       // Optional filter conditions
     */
    public function handle(string $collectionName, array $vector, int $top = 10, ?array $filter = null): Response
    {
        $payload = [
            'vector' => $vector,
            'top' => $top,
        ];

        if ($filter) {
            $payload['filter'] = $filter;
        }

        return $this->client->post("/collections/{$collectionName}/points/search", $payload);
    }
}