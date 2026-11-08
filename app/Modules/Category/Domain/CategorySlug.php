<?php

declare(strict_types=1);

namespace App\Modules\Category\Domain;

use InvalidArgumentException;

class CategorySlug
{
    public function __construct(
        public readonly string $value
    ) {
        if (empty($value) || !preg_match('/^[a-z0-9-]+$/', $value)) {
            throw new InvalidArgumentException("Invalid category slug format");
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
