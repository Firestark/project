<?php

use Mockery as mockery;

app::share ( 'habit', function ( )
{
    return mockery::mock ( habit::class, [ uniqid ( ), 'Exercise' ] );
} );