<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest.php';

$app = new firestark\app;
$app->instance ( 'app', $app );
$app->instance ( 'statuses', new firestark\statuses );
$app->instance ( 'tester', new firestark\tester ( $app ) );

facade::setFacadeApplication ( $app );


including ( __DIR__ . '/../bindings' );
including ( __DIR__ . '/../app/procedures' );

including ( __DIR__ . '/testcases' );


$app [ 'tester' ]->run ( );