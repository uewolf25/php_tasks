<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

use Src\Controller\CrudClass;

/** @var Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__ . '/../../vendor/autoload.php';
$loader->addPsr4('Src\\', __DIR__ . '/../lib');

$app = AppFactory::create();

// Middleware
$contentLengthMiddleware = new \Slim\Middleware\ContentLengthMiddleware();
$app->add($contentLengthMiddleware);

$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write('Hello, World!');
    return $response;
});

$app->group('/tasks', function (RouteCollectorProxy $group) {
    $group->get('', CrudClass::class . ':getAllTitle');
    $group->post('', CrudClass::class . ':postTitle');

    $group->get('/{id}', CrudClass::class . ':getTitle');
    $group->put('/{id}', CrudClass::class . ':updateTitle');
    $group->delete('/{id}', CrudClass::class . ':deleteTitle');
});

// 実行
$app->run();