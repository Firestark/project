<?php

require __DIR__ . '/../../vendor/autoload.php';

$app = new firestark\app;
$app->instance ( 'app', $app );
$app->instance ( 'statuses', new firestark\statuses );
$app->instance ( 'request', http\request::capture ( ) );
$app->instance ( 'response', new http\response\factory ( firestark\json\response::class ) );
$app->instance ( 'router', new firestark\router );

facade::setFacadeApplication ( $app );


including ( __DIR__ . '/../../bindings' );
including ( __DIR__ . '/bindings' );
including ( __DIR__ . '/routes' );
including ( __DIR__ . '/statuses' );
including ( __DIR__ . '/../../app/procedures' );


$dispatcher = new http\dispatcher ( $app [ 'router' ]->routes, $app [ 'router' ]->groups );
$kernel = new firestark\kernel ( $dispatcher );
$response = $kernel->handle ( $app [ 'request' ] );

$response->send ( );