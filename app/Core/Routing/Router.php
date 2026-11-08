<?php

declare(strict_types=1);

namespace App\Core\Routing;

use Exception;

class Router
{
    private array $routes = [];

    public function add(string $method, string $uri, mixed $handler, ?string $name = null): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'handler' => $handler,
            'name' => $name
        ];
    }

    public function resolve(string $method, string $uri): array
    {
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $this->matchUri($route['uri'], $uri)) {
                return [
                    'handler' => $route['handler'],
                    'params' => $this->extractParams($route['uri'], $uri)
                ];
            }
        }

        throw new Exception("Route not found", 404);
    }

    private function matchUri(string $routeUri, string $requestUri): bool
    {
        $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([^/]+)', $routeUri);
        $pattern = "#^" . $pattern . "$#";
        return (bool)preg_match($pattern, $requestUri);
    }

    private function extractParams(string $routeUri, string $requestUri): array
    {
        $params = [];
        $routeParts = explode('/', trim($routeUri, '/'));
        $requestParts = explode('/', trim($requestUri, '/'));

        foreach ($routeParts as $index => $part) {
            if (str_starts_with($part, '{') && str_ends_with($part, '}')) {
                $paramName = trim($part, '{}');
                $params[$paramName] = $requestParts[$index] ?? null;
            }
        }

        return $params;
    }
}
