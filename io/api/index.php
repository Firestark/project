<?php

use Firestark\App;
use League\Route\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Relay\Relay;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory as Request;

require __DIR__ . '/../../vendor/autoload.php';

$app = new App;
$app->instance('app', $app);
Facade::setFacadeApplication($app);

$app->instance('router', new Firestark\Router);
$app->instance('response', new Firestark\Json\Response);
$app->instance('statuses', new Firestark\Statuses);

including(__DIR__ . '/routes');
including(__DIR__ . '/bindings');
including(__DIR__ . '/statuses');
including(__DIR__ . '/../../bindings');
including(__DIR__ . '/../../app/procedures');

$relay = new Relay([
    new Firestark\Route($app['router'])
]);

$request = Request::fromGlobals();
$response = $relay->handle($request);
(new Zend\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
