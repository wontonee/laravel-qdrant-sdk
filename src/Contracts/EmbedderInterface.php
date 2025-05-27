<?php

namespace Wontonee\LarQ\Contracts;

interface EmbedderInterface
{
    /**
     * Generate a vector embedding from text.
     *
     * @param string $text
     * @return array
     */
    public function embed(string $text): array;
}