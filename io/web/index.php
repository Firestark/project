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
$app->instance('response', new Firestark\Response);
$app->instance('view', new Firestark\View($app['response'], __DIR__ . '/views'));
$app->instance('statuses', new Firestark\Statuses);
$app->instance('session', new Firestark\Session);
$app->instance('redirector', new Firestark\Redirector($app['session']->get('previous-uri', '/')));

including(__DIR__ . '/routes');
including(__DIR__ . '/bindings');
including(__DIR__ . '/statuses');
including(__DIR__ . '/../../bindings');
including(__DIR__ . '/../../app/procedures');

$relay = new Relay([
    (new Middlewares\Debugbar())->inline(),
    new Firestark\RouterMiddleware($app['router'])
]);

$request = Request::fromGlobals();
$response = $relay->handle($request);
(new Zend\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
$app['session']->flash('previous-uri', $request->getUri()->getPath());