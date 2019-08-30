<?php

use Relay\Relay;
use Zend\Diactoros\Response as response;
use Zend\Diactoros\Response\HtmlResponse as html;
use Zend\Diactoros\ServerRequestFactory as request;
use Zend\Diactoros\ResponseFactory as responseFactory;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../tools/readability.php';

$app = new firestark\app;
$app->instance ( 'app', $app );
$app->instance ( 'session', new firestark\session );
$app->instance ( 'statuses', new firestark\statuses );
$app->instance ( 'request', request::fromGlobals ( ) );
$app->instance ( 'response', new firestark\http\response ( html::class ) );
$app->instance ( 'router', new firestark\http\router );

facade::setFacadeApplication ( $app );

including ( __DIR__ . '/../../bindings' );
including ( __DIR__ . '/bindings' );
including ( __DIR__ . '/routes' );
including ( __DIR__ . '/statuses' );
including ( __DIR__ . '/../../app/procedures' );

$dispatcher = new firestark\http\dispatcher ( $app [ 'router' ]->routes );

$relay = new Relay ( [
    ( new Middlewares\Debugbar ( ) )->responseFactory ( $app [ 'response' ] )->inline ( ),
    ( new Middlewares\Whoops )->responseFactory ( $app [ 'response' ] )->catchErrors ( true ),
    new \firestark\middlewares\redirect ( $app ),
    new \firestark\middlewares\input ( $app ),
    new \firestark\middlewares\requestHandler ( $dispatcher ),
] );

$response = $relay->handle ( $app [ 'request' ] );
( new Zend\HttpHandlerRunner\Emitter\SapiEmitter )->emit ( $response );