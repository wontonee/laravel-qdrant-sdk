<?php

namespace Wontonee\LarQ\Qdrant\Points;

use Wontonee\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class UpsertPoints
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * @param string $collectionName
     * @param array $points (e.g., [
     *   ['id' => 1, 'vector' => [...], 'payload' => [...]],
     *   ...
     * ])
     */
    public function handle(string $collectionName, array $points): Response
    {
        return $this->client->put("/collections/{$collectionName}/points", [
            'points' => $points,
        ]);
    }
}