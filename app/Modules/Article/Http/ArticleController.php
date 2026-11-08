<?php

declare(strict_types=1);

namespace App\Modules\Article\Http;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\View;
use App\Modules\Article\Application\GetArticle\GetArticleUseCase;
use App\Modules\Article\Application\GetLatestArticles\GetLatestArticlesUseCase;

class ArticleController
{
    public function __construct(
        private View $view,
        private GetArticleUseCase $getArticle,
        private GetLatestArticlesUseCase $getLatest
    ) {}

    public function show(Request $request, string $slug): Response
    {
        [$article, $related] = $this->getArticle->execute($slug);

        return $this->view->render('pages/article.tpl', [
            'article' => $article,
            'related' => $related,
            'title' => $article->getTitle()->value
        ]);
    }

    public function index(Request $request): Response
    {
        $articles = $this->getLatest->execute();

        return $this->view->render('pages/home.tpl', [
            'articles' => $articles
        ]);
    }
}
