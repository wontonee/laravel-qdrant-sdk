<?php

namespace Wontonee\LarQ\Providers;

use Illuminate\Support\ServiceProvider;
use Wontonee\LarQ\Contracts\EmbedderInterface;
use Wontonee\LarQ\Embedders\OpenAIEmbedder;

class LarQServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind default embedder
        $this->app->bind(EmbedderInterface::class, function () {
            return new OpenAIEmbedder();
        });

        // Merge configuration
        $this->mergeConfigFrom(__DIR__ . '/../Config/larq.php', 'larq');
    }

    public function boot(): void
    {
        // Publish config
        $this->publishes([
            __DIR__ . '/../Config/larq.php' => config_path('larq.php'),
        ], 'larq-config');
    }
}