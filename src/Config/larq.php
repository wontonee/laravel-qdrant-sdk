<?php

return [
    'host' => env('LARQ_HOST', 'http://localhost:6333'),
    'api_key' => env('LARQ_API_KEY'),

    'openai_api_key' => env('OPENAI_API_KEY'),
    'openai_model' => env('OPENAI_MODEL', 'text-embedding-ada-002'),

    'gemini_api_key' => env('GEMINI_API_KEY'),
    'gemini_model' => env('GEMINI_MODEL', 'models/embedding-001'),
];