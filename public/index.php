<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Container\Container;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Routing\Router;
use App\Core\Middleware\MiddlewarePipeline;
use App\Core\Exception\ExceptionHandler;

$container = new Container();
$request = new Request();
$router = new Router();
$pipeline = new MiddlewarePipeline();
$exceptionHandler = new ExceptionHandler();
