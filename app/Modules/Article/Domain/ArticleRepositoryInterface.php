<?php

declare(strict_types=1);

namespace App\Modules\Article\Domain;

use App\Modules\Category\Domain\CategoryId;

interface ArticleRepositoryInterface
{
    public function findById(ArticleId $id): ?Article;
    public function findBySlug(ArticleSlug $slug): ?Article;
    public function save(Article $article): void;
    public function delete(ArticleId $id): void;
    public function getLatest(int $limit): array;
    public function getByCategory(CategoryId $categoryId, int $offset, int $limit): array;
    public function getRelated(Article $article, int $limit): array;
    public function countByCategory(CategoryId $categoryId): int;
    public function incrementViews(ArticleId $id): void;
}
