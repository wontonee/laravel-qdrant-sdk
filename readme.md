# Laravel Qdrant SDK: Qdrant Vector Database Integration for Laravel

Laravel Qdrant SDK is a Laravel package that provides a simple, expressive interface for working with the Qdrant vector database. It supports collection management, vector upserts, similarity search, and integration with embedders like OpenAI and Gemini.

## Features
- Create, update, delete, and list Qdrant collections
- Upsert and manage vector points
- Perform similarity search and recommendations
- Easily integrate with OpenAI or Gemini for vector embeddings
- Simple trait for adding vector support to Eloquent models

## Installation

1. **Require the package:**
   ```sh
   composer require wontonee/laravel-qdrant-sdk
   ```

2. **Publish the config:**
   ```sh
   php artisan vendor:publish --provider="Wontonee\LarQ\Providers\LarQServiceProvider" --tag=larq-config
   ```

3. **Set your .env variables:**
   ```env
   LARQ_HOST=http://localhost:6333
   LARQ_API_KEY=
   OPENAI_API_KEY=sk-...
   OPENAI_MODEL=text-embedding-ada-002
   GEMINI_API_KEY=...
   GEMINI_MODEL=models/embedding-001
   ```

4. **Run Qdrant with persistent storage (recommended for local dev):**
   ```sh
   docker run -p 6333:6333 -v $(pwd)/qdrant_storage:/qdrant/storage qdrant/qdrant
   ```

## Usage

### Creating a Collection
```php
use Wontonee\LarQ\Qdrant\Collections\CreateCollection;

$vectorParams = [
    'size' => 3,
    'distance' => 'Cosine',
];
$response = (new CreateCollection())->handle('my_collection', $vectorParams);
```

### Upserting Points
```php
use Wontonee\LarQ\Qdrant\Points\UpsertPoints;

$points = [
    [
        'id' => 1,
        'vector' => [0.1, 0.2, 0.3],
        'payload' => ['label' => 'A'],
    ],
];
$response = (new UpsertPoints())->handle('my_collection', $points);
```

### Scrolling Points
```php
use Wontonee\LarQ\Qdrant\Points\ScrollPoints;
$response = (new ScrollPoints())->handle('my_collection', 10);
```

### Listing All Collections
```php
use Wontonee\LarQ\Qdrant\Collections\ListCollections;
$response = (new ListCollections())->handle();
```

### Using the HasVectors Trait
Add vector support to your Eloquent model:
```php
use Wontonee\LarQ\Traits\HasVectors;

class Product extends Model {
    use HasVectors;
    // Optionally override vectorText(), vectorPayload(), etc.
}
```

### Example Controller Test
See `QdrantDemoController` for a full example of creating a collection, upserting points, and listing them.

## Troubleshooting
- **Data disappears after restart:** Make sure Qdrant is running with persistent storage (see above).
- **Connection issues:** Check your `LARQ_HOST` and API key settings in `.env`.

## License
MIT
