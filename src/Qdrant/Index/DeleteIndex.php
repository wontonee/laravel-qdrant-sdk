<?php

namespace Wontonee\LarQ\Qdrant\Index;

use Wontonee\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class DeleteIndex
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * Delete an index for a specific payload field.
     *
     * @param string $collectionName
     * @param string $fieldName
     */
    public function handle(string $collectionName, string $fieldName): Response
    {
        return $this->client->delete("/collections/{$collectionName}/indexes/{$fieldName}");
    }
}