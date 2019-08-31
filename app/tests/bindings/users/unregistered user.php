<?php

app::assumption ( 'unregistered user', function ( $app )
{    
    $app [ 'user manager' ]
        ->shouldReceive ( 'registered' )
        ->with ( $app [ 'user' ] )
        ->once ( )
        ->andReturn ( false );
    
    return $app [ 'user' ];
} );