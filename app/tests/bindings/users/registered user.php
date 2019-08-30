<?php

app::assumption ( 'registered user', function ( $app )
{
    $app [ 'user manager' ]
        ->shouldReceive ( 'registered' )
        ->with ( $app [ 'user' ] )
        ->andReturn ( true );
    
    return $app [ 'user' ];
} );