<?php

declare(strict_types=1);

namespace App\Modules\Article\Application\DTO;

class ArticleData
{
    public function __construct(
        public readonly string $title,
        public readonly string $slug,
        public readonly string $description,
        public readonly string $content,
        public readonly array $categoryIds = [],
        public readonly ?string $imagePath = null
    ) {}
}
