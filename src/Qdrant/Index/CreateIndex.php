<?php

namespace Wontonee\LarQ\Qdrant\Index;

use Wontonee\LarQ\Qdrant\Client;
use Illuminate\Http\Client\Response;

class CreateIndex
{
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * Create an index for a specific payload field.
     *
     * @param string $collectionName
     * @param string $fieldName
     * @param string $fieldType        // 'keyword' or 'integer', etc.
     */
    public function handle(string $collectionName, string $fieldName, string $fieldType = 'keyword'): Response
    {
        return $this->client->put("/collections/{$collectionName}/indexes/{$fieldName}", [
            'field_type' => $fieldType
        ]);
    }
}