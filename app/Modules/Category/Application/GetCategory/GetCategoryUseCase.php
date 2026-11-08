<?php

declare(strict_types=1);

namespace App\Modules\Category\Application\GetCategory;

use App\Modules\Article\Domain\ArticleRepositoryInterface;
use App\Modules\Category\Domain\CategoryRepositoryInterface;
use App\Modules\Category\Domain\CategorySlug;
use App\Modules\Category\Domain\Exceptions\CategoryNotFoundException;
use InvalidArgumentException;

class GetCategoryUseCase
{
    public const PER_PAGE = 6;

    public function __construct(
        private CategoryRepositoryInterface $categories,
        private ArticleRepositoryInterface $articles
    ) {}

    public function execute(string $slug, int $page): array
    {
        try {
            $category = $this->categories->findBySlug(new CategorySlug($slug));
        } catch (InvalidArgumentException) {
            $category = null;
        }

        if (!$category) {
            throw new CategoryNotFoundException("Category $slug not found");
        }

        $total = $this->articles->countByCategory($category->getId());
        $totalPages = max(1, (int)ceil($total / self::PER_PAGE));
        $page = min(max(1, $page), $totalPages);

        return [
            $category,
            $this->articles->getByCategory($category->getId(), ($page - 1) * self::PER_PAGE, self::PER_PAGE),
            ['current' => $page, 'total' => $totalPages],
        ];
    }
}
