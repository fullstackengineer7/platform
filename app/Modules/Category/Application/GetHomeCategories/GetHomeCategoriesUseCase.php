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

    public function execute(int $articlesPerCategory = 5): array
    {
        $result = [];

        foreach ($this->categories->findAll() as $category) {
            $result[] = [
                'category' => $category,
                'articles' => $this->articles->getByCategory($category->getId(), 0, $articlesPerCategory),
            ];
        }

        return $result;
    }
}
