<?php

declare(strict_types=1);

namespace App\Modules\Category\Domain;

interface CategoryRepositoryInterface
{
    public function findById(CategoryId $id): ?Category;
    public function findBySlug(CategorySlug $slug): ?Category;
    public function save(Category $category): void;
    public function delete(CategoryId $id): void;
    public function findAll(): array;
    public function findByArticleId(int $articleId): array;
}
