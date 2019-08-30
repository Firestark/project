<?php

use Mockery as mockery;

app::share ( 'registered user', function ( $app )
{    
    $app [ 'user manager' ]
        ->shouldReceive ( 'registered' )
        ->with ( $app [ 'user' ] )
        ->andReturn ( true );
    
    return $app [ 'user' ];
} );