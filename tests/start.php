<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new firestark\app;
$app->instance ( 'app', $app );
$app->instance ( 'statuses', new firestark\statuses );

facade::setFacadeApplication ( $app );


including ( __DIR__ . '/../bindings' );
including ( __DIR__ . '/../app/procedures' );