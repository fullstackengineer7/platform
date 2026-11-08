<?php

declare(strict_types=1);

namespace App\Core\Middleware;

use App\Core\Http\Request;
use App\Core\Http\Response;

class MiddlewarePipeline
{
    private array $middlewares = [];

    public function add(MiddlewareInterface $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function handle(Request $request, callable $coreHandler): Response
    {
        $pipeline = array_reduce(
            array_reverse($this->middlewares),
            function (callable $next, MiddlewareInterface $middleware) {
                return function (Request $request) use ($next, $middleware) {
                    return $middleware->handle($request, $next);
                };
            },
            $coreHandler
        );

        return $pipeline($request);
    }
}
