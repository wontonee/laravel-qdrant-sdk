<?php

namespace Wontonee\LarQ\Qdrant\Payload;

use Wontonee\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class ClearPayload
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * Clear all payload fields for selected point IDs.
     *
     * @param string $collectionName
     * @param array $ids
     */
    public function handle(string $collectionName, array $ids): Response
    {
        return $this->client->post("/collections/{$collectionName}/points/payload/clear", [
            'points' => $ids,
        ]);
    }
}