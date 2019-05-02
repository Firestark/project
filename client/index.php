<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

$app = new firestark\app;
$app->instance ( 'app', $app );
$app->instance ( 'session', new firestark\session );
$app->instance ( 'statuses', new firestark\statuses );
$app->instance ( 'request', firestark\request::capture ( ) );
$app->instance ( 'response', new http\response\factory ( firestark\response::class ) );
$app->instance ( 'redirector', new firestark\redirector ( BASEURL, $app [ 'session' ]->get ( 'uri', '/' ) ) );
$app->instance ( 'router', new firestark\router );
$app [ 'session' ]->flash ( 'uri', $app [ 'request' ]->uri );

facade::setFacadeApplication ( $app );

requiring ( __DIR__ . '/routes' );
requiring ( __DIR__ . '/bindings' );
requiring ( __DIR__ . '/statuses' );
requiring ( __DIR__ . '/../app/procedures' );


$dispatcher = new http\dispatcher ( $app [ 'router' ]->routes, $app [ 'router' ]->groups );
$kernel = new firestark\kernel ( $dispatcher );
$response = $kernel->handle ( $app [ 'request' ] );

$response->send ( );