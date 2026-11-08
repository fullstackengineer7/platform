<?php

declare(strict_types=1);

namespace App\Core\Exception;

use App\Core\Http\Response;
use Exception;
use Throwable;

class ExceptionHandler
{
    public function handle(Throwable $e): Response
    {
        $response = new Response();
        $code = ($e instanceof Exception) ? $e->getCode() : 500;

        if ($code === 0) $code = 500;
        if ($code < 100 || $code > 599) $code = 500;

        $response->setStatusCode($code);

        // In production, we would hide detailed errors.
        $response->setContent("<h1>Error $code</h1><p>" . htmlspecialchars($e->getMessage()) . "</p>");

        return $response;
    }
}
