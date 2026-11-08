<?php

declare(strict_types=1);

namespace App\Core\Http;

class Request
{
    private array $queryParams;
    private array $postData;
    private array $files;
    private string $uri;
    private string $method;
    private array $headers;

    public function __construct()
    {
        $this->queryParams = $_GET;
        $this->postData = $_POST;
        $this->files = $_FILES;
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->headers = getallheaders();
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function getPostData(): array
    {
        return $this->postData;
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function getHeader(string $name): ?string
    {
        return $this->headers[$name] ?? $this->headers[strtolower($name)] ?? null;
    }

    public function getParam(string $key, mixed $default = null): mixed
    {
        return $this->postData[$key] ?? $this->queryParams[$key] ?? $default;
    }
}
