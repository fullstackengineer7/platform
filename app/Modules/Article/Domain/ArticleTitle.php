<?php

declare(strict_types=1);

namespace App\Modules\Article\Domain;

use InvalidArgumentException;

class ArticleTitle
{
    public function __construct(
        public readonly string $value
    ) {
        if (empty($value) || strlen($value) < 3) {
            throw new InvalidArgumentException("Title must be at least 3 characters long");
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
