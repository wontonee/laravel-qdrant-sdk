<?php

namespace Wontonee\LarQ\Qdrant\Vectors;

use Wontonee\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class DeleteVector
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * Delete vector(s) by name from given point IDs.
     *
     * @param string $collectionName
     * @param array $vectorNames       // e.g., ['default', 'secondary']
     * @param array $pointIds          // e.g., [1, 2, 3]
     */
    public function handle(string $collectionName, array $vectorNames, array $pointIds): Response
    {
        return $this->client->post("/collections/{$collectionName}/points/vectors/delete", [
            'vectors' => $vectorNames,
            'points' => $pointIds,
        ]);
    }
}