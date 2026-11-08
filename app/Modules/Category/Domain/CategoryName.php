<?php

declare(strict_types=1);

namespace App\Modules\Category\Domain;

use InvalidArgumentException;

class CategoryName
{
    public function __construct(
        public readonly string $value
    ) {
        if (empty($value) || strlen($value) < 2) {
            throw new InvalidArgumentException("Category name must be at least 2 characters long");
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
