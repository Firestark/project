<?php

use Mockery as mockery;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/tools.php';
require __DIR__ . '/../../tools/readability.php';


$app = new firestark\app;
$app->instance ( 'app', $app );

facade::setFacadeApplication ( $app );


// including ( __DIR__ . '/../procedures' );
// including ( __DIR__ . '/bindings' );
including ( __DIR__ . '/testcases' );


foreach ( collector::all ( ) as $feature => $tests )
    testing ( $feature, $tests, $app );