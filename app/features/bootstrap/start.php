<?php

require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest.php';

$app = new firestark\app;
$app->instance ( 'app', $app );

facade::setFacadeApplication ( $app );

including ( __DIR__ . '/../../procedures' );