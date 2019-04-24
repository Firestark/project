<?php

use Jenssegers\Blade\Blade;

require __DIR__ . '/vendor/autoload.php';

$app = new firestark\app;
$app->instance ( 'app', $app );
$app->instance ( 'session', new firestark\session );
$app->instance ( 'statuses', new firestark\statuses );
$app->instance ( 'request', firestark\request::capture ( ) );
$app->instance ( 'response', new http\response\factory ( firestark\response::class ) );
$app->instance ( 'redirector', new firestark\redirector ( 'http://firestark-project', $app [ 'session' ]->get ( 'uri', '/' ) ) );
$app->instance ( 'router', new firestark\router );
$app->instance ( 'view', 
    new firestark\view ( 
        $app [ 'response' ], 
        new Blade ( __DIR__ . '/views', __DIR__ . '/storage/cache/blade' ) 
    ) 
);

$app [ 'session' ]->flash ( 'uri', $app [ 'request' ]->uri );

facade::setFacadeApplication ( $app );

requiring ( __DIR__ . '/routes' );
requiring ( __DIR__ . '/bindings' );
requiring ( __DIR__ . '/statuses' );
requiring ( __DIR__ . '/../app/app' );


$dispatcher = new http\dispatcher ( $app [ 'router' ]->routes );
$kernel = new firestark\kernel ( $dispatcher );
$response = $kernel->handle ( $app [ 'request' ] );

$response->send ( );