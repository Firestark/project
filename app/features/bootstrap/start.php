<?php

use Mockery as mockery;

require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../tools/readability.php';


$app = new firestark\app;
$app->instance ( 'app', $app );

facade::setFacadeApplication ( $app );


including ( __DIR__ . '/../../procedures' );