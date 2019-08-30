<?php

app::assumption ( 'habit manager add', function ( $app )
{
    $app [ 'habit manager' ]
        ->shouldReceive ( 'add' )
        ->with ( $app [ 'habit' ], $app [ 'user' ] );
} );