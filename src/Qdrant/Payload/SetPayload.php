<?php

namespace Wontonee\LarQ\Qdrant\Payload;

use Wontonee\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class SetPayload
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * Set or update payload for specific point IDs.
     *
     * @param string $collectionName
     * @param array $payload
     * @param array $ids
     */
    public function handle(string $collectionName, array $payload, array $ids): Response
    {
        return $this->client->post("/collections/{$collectionName}/points/payload", [
            'payload' => $payload,
            'points' => $ids,
        ]);
    }
}