<?php

declare(strict_types=1);

namespace App\Modules\Article\Application\GetArticle;

use App\Modules\Article\Domain\Article;
use App\Modules\Article\Domain\ArticleSlug;
use App\Modules\Article\Domain\ArticleRepositoryInterface;
use App\Modules\Article\Domain\ArticleNotFoundException;

class GetArticleUseCase
{
    public function __construct(
        private ArticleRepositoryInterface $repository
    ) {}

    public function execute(string $slug): Article
    {
        $article = $this->repository->findBySlug(new ArticleSlug($slug));

        if (!$article) {
            throw new ArticleNotFoundException("Article with slug $slug not found");
        }

        return $article;
    }
}
