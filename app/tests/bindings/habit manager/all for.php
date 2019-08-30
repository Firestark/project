<?php

app::assumption ( 'habit manager all for', function ( $app )
{
    $app [ 'habit manager' ]
        ->shouldReceive ( 'allFor' )
        ->with ( $app [ 'user' ] )
        ->andReturn ( $app [ 'habits' ] );
} );