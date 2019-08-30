<?php

use Mockery as mockery;

app::share ( 'user manager', function ( $app )
{
    return mockery::mock ( user\manager::class );
} );
