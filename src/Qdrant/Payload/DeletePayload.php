<?php

namespace Wontonee\LarQ\Qdrant\Payload;

use Wontonee\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class DeletePayload
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * Delete specified payload keys from selected points.
     *
     * @param string $collectionName
     * @param array $keys              // e.g., ['category', 'tag']
     * @param array $ids               // Point IDs
     */
    public function handle(string $collectionName, array $keys, array $ids): Response
    {
        return $this->client->post("/collections/{$collectionName}/points/payload/delete", [
            'keys' => $keys,
            'points' => $ids,
        ]);
    }
}