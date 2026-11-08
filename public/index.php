<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Container\Container;
use App\Core\Database\Database;
use App\Core\Exception\ExceptionHandler;
use App\Core\Http\Request;
use App\Core\Middleware\MiddlewarePipeline;
use App\Core\Routing\Router;
use App\Modules\Article\Domain\ArticleRepositoryInterface;
use App\Modules\Article\Http\ArticleController;
use App\Modules\Article\Infrastructure\MySqlArticleRepository;
use App\Modules\Category\Domain\CategoryRepositoryInterface;
use App\Modules\Category\Http\CategoryController;
use App\Modules\Category\Infrastructure\MySqlCategoryRepository;

$exceptionHandler = new ExceptionHandler();

try {
    $container = new Container();

    $container->singleton(Database::class, fn() => new Database(
        'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME') . ';charset=utf8mb4',
        (string)getenv('DB_USER'),
        (string)getenv('DB_PASS')
    ));
    $container->singleton(CategoryRepositoryInterface::class, MySqlCategoryRepository::class);
    $container->singleton(ArticleRepositoryInterface::class, MySqlArticleRepository::class);

    $request = new Request();

    $router = new Router();
    $router->add('GET', '/', [CategoryController::class, 'index']);
    $router->add('GET', '/category/{slug}', [CategoryController::class, 'show']);
    $router->add('GET', '/article/{slug}', [ArticleController::class, 'show']);

    $pipeline = new MiddlewarePipeline();

    $response = $pipeline->handle($request, function (Request $request) use ($router, $container) {
        $route = $router->resolve($request->getMethod(), $request->getUri());
        [$class, $method] = $route['handler'];

        return $container->get($class)->$method($request, ...$route['params']);
    });
} catch (Throwable $e) {
    $response = $exceptionHandler->handle($e);
}

$response->send();
