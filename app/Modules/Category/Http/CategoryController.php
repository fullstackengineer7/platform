<?php

declare(strict_types=1);

namespace App\Modules\Category\Http;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\View;
use App\Modules\Category\Application\GetCategory\GetCategoryUseCase;
use App\Modules\Category\Application\GetHomeCategories\GetHomeCategoriesUseCase;

class CategoryController
{
    public function __construct(
        private View $view,
        private GetCategoryUseCase $getCategory,
        private GetHomeCategoriesUseCase $getHomeCategories
    ) {}

    public function index(Request $request): Response
    {
        return $this->view->render('pages/home.tpl', [
            'items' => $this->getHomeCategories->execute(),
            'title' => 'Blog Platform'
        ]);
    }

    public function show(Request $request, string $slug): Response
    {
        $sort = $request->getParam('sort') === 'views' ? 'views' : 'date';

        [$category, $articles, $pagination] = $this->getCategory->execute(
            $slug,
            (int)$request->getParam('page', 1),
            $sort
        );

        return $this->view->render('pages/category.tpl', [
            'category' => $category,
            'articles' => $articles,
            'pagination' => $pagination,
            'sort' => $sort,
            'title' => $category->getName()->value
        ]);
    }
}
