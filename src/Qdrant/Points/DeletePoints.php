<?php

namespace Wontonee\LarQ\Qdrant\Points;

use Wontonee\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class DeletePoints
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * Delete one or more points by ID.
     *
     * @param string $collectionName
     * @param array $ids
     */
    public function handle(string $collectionName, array $ids): Response
    {
        return $this->client->post("/collections/{$collectionName}/points/delete", [
            'points' => $ids,
        ]);
    }
}