<?php

declare(strict_types=1);

namespace App\Modules\Category\Application\GetHomeCategories;

use App\Modules\Article\Domain\ArticleRepositoryInterface;
use App\Modules\Category\Domain\CategoryRepositoryInterface;

class GetHomeCategoriesUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $categories,
        private ArticleRepositoryInterface $articles
    ) {}

    public function execute(int $articlesPerCategory = 3): array
    {
        $grouped = $this->articles->getLatestForCategories($articlesPerCategory);
        $result = [];

        foreach ($this->categories->findAll() as $category) {
            $articles = $grouped[$category->getId()->value] ?? [];

            if ($articles) {
                $result[] = ['category' => $category, 'articles' => $articles];
            }
        }

        return $result;
    }
}
