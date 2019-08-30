<?php

use Mockery as mockery;

app::share ( 'habit manager', function ( $app )
{
    return mockery::mock ( habit\manager::class );
} );