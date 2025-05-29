<?php

namespace Wontonee\LarQ\Qdrant\Collections;

use Wontonee\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class CreateCollection
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function handle(string $collectionName, array $vectorParams): Response
    {
        // Send a full schema (blueprint) for the collection
        return $this->client->put("/collections/{$collectionName}", $vectorParams);
        
    }
}