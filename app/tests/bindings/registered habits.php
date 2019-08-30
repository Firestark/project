<?php

use Mockery as mockery;

app::share ( 'habits', function ( $app ) : array
{
    return [ 
        mockery::mock ( habit::class ), 
        mockery::mock ( habit::class ) 
    ];
} );