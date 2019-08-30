<?php

use Mockery as mockery;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/tools.php';
require __DIR__ . '/../../tools/readability.php';


$app = new firestark\app;
$app->instance ( 'app', $app );

facade::setFacadeApplication ( $app );


including ( __DIR__ . '/../procedures' );
including ( __DIR__ . '/testcases' );


function testing ( string $feature, array $tests, $app )
{
    describe ( $feature, function ( ) use ( $app, $tests )
    {
        beforeEach ( function ( ) 
        {
            including ( __DIR__ . '/bindings' );
        } );

        foreach ( $tests as $description => $test )
            it ( $description, function ( ) use ( $test, $app )
            {
                $test ( $app );
            } );

        afterEach ( function ( ) 
        {
            mockery::close ( );
        } );
    } );
}

foreach ( collector::all ( ) as $feature => $tests );
    testing ( $feature, $tests, $app );