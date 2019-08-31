<?php

app::assumption ( 'registered user', function ( $app )
{
    $app [ 'user manager' ]
        ->shouldReceive ( 'registered' )
        ->with ( $app [ 'user' ] )
        ->once ( )
        ->andReturn ( true );
    
    return $app [ 'user' ];
} );