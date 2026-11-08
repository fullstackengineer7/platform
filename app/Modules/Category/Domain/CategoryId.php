<?php

declare(strict_types=1);

namespace App\Modules\Category\Domain;

class CategoryId
{
    public function __construct(
        public readonly int $value
    ) {}

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
