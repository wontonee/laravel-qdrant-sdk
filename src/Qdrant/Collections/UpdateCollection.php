<?php

namespace Wontonee\LarQ\Qdrant\Collections;

use Wontonee\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class UpdateCollection
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * Update an existing collection's settings.
     *
     * @param string $collectionName
     * @param array $settings          // Vector, optimizer config, etc.
     */
    public function handle(string $collectionName, array $settings): Response
    {
        return $this->client->post("/collections/{$collectionName}/update", $settings);
    }
}