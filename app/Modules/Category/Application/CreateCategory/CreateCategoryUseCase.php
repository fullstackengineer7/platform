<?php

declare(strict_types=1);

namespace App\Modules\Category\Application\CreateCategory;

use App\Modules\Category\Domain\Category;
use App\Modules\Category\Domain\CategoryId;
use App\Modules\Category\Domain\CategoryName;
use App\Modules\Category\Domain\CategorySlug;
use App\Modules\Category\Domain\CategoryRepositoryInterface;

class CreateCategoryUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    ) {}

    public function execute(string $name, string $slug, string $description): Category
    {
        $category = new Category(
            new CategoryId(0),
            new CategoryName($name),
            new CategorySlug($slug),
            $description
        );

        $this->repository->save($category);

        return $category;
    }
}
