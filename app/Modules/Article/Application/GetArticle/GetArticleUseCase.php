<?php

declare(strict_types=1);

namespace App\Modules\Article\Application\GetArticle;

use App\Modules\Article\Domain\Article;
use App\Modules\Article\Domain\ArticleSlug;
use App\Modules\Article\Domain\ArticleRepositoryInterface;
use App\Modules\Article\Domain\Exceptions\ArticleNotFoundException;

class GetArticleUseCase
{
    public function __construct(
        private ArticleRepositoryInterface $repository
    ) {}

    public function execute(string $slug): array
    {
        $article = $this->repository->findBySlug(new ArticleSlug($slug));

        if (!$article || $article->getStatus() !== \App\Modules\Article\Domain\ArticleStatus::PUBLISHED) {
            throw new ArticleNotFoundException("Article with slug $slug not found");
        }

        $this->repository->incrementViews($article->getId());

        return [$article, $this->repository->getRelated($article, 4)];
    }
}
