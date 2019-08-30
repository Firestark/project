<?php

use Mockery as mockery;

app::share ( 'habit manager', function ( $app )
{
    $manager = mockery::mock ( habit\manager::class );

    $manager
        ->shouldReceive ( 'allFor' )
        ->with ( $app [ 'user' ] )
        ->andReturn ( $app [ 'habits' ] );

    return $manager;
} );