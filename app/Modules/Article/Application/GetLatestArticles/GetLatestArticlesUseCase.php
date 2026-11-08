<?php

declare(strict_types=1);

namespace App\Modules\Article\Application\GetLatestArticles;

use App\Modules\Article\Domain\Article;
use App\Modules\Article\Domain\ArticleRepositoryInterface;

class GetLatestArticlesUseCase
{
    public function __construct(
        private ArticleRepositoryInterface $repository
    ) {}

    public function execute(int $limit = 10): array
    {
        return $this->repository->getLatest($limit);
    }
}
