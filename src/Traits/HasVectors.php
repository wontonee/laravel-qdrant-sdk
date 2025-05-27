<?php

namespace Wontonee\LarQ\Traits;

use Illuminate\Support\Str;
use Wontonee\LarQ\Contracts\EmbedderInterface;
use Wontonee\LarQ\Embedders\GeminiEmbedder;
use Wontonee\LarQ\Embedders\OpenAIEmbedder;
use Wontonee\LarQ\Qdrant\Points\UpsertPoints;

trait HasVectors
{
    public function vectorText(): string
    {
        return method_exists($this, 'getVectorText')
            ? $this->getVectorText()
            : (string) $this;
    }

    public function vectorPayload(): array
    {
        return method_exists($this, 'getVectorPayload')
            ? $this->getVectorPayload()
            : ['id' => $this->getKey()];
    }

    public function vectorId(): string|int
    {
        return method_exists($this, 'getVectorId')
            ? $this->getVectorId()
            : $this->getKey();
    }

    public function vectorCollection(): string
    {
        return method_exists($this, 'getVectorCollection')
            ? $this->getVectorCollection()
            : Str::plural(Str::snake(class_basename($this)));
    }

    public function vectorEmbedder(): EmbedderInterface
    {
        if (method_exists($this, 'getEmbedder')) {
            return $this->getEmbedder();
        }

        return app(EmbedderInterface::class, [], function () {
            return new OpenAIEmbedder();
        });
    }

    public function upsertToQdrant(): void
    {
        $vector = $this->vectorEmbedder()->embed($this->vectorText());

        (new UpsertPoints())->handle($this->vectorCollection(), [
            [
                'id' => $this->vectorId(),
                'vector' => $vector,
                'payload' => $this->vectorPayload(),
            ]
        ]);
    }
}