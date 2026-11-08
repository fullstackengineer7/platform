<?php

declare(strict_types=1);

namespace App\Modules\Article\Domain;

class ArticleId
{
    public function __construct(
        public readonly int $value
    ) {}

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
