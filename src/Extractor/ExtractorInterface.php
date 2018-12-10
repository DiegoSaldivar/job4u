<?php
namespace App\Extractor;

interface ExtractorInterface
{
    public function extract($element);

    public function extractList(array $elements) : array;
}

