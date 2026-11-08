<?php

declare(strict_types=1);

namespace App\Modules\Category\Http;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\View;
use App\Modules\Category\Application\GetCategoryUseCase;

class CategoryController
{
    public function __construct(
        private View $view,
        private GetCategoryUseCase $getCategory
    ) {}

    public function show(Request $request, string $slug): Response
    {
        $category = $this->getCategory->execute($slug);

        return $this->view->render('pages/category.tpl', [
            'category' => $category
        ]);
    }
}
