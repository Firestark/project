<?php

use Mockery as mockery;

app::share ( 'user', function ( $app )
{
    return mockery::mock ( user::class );
} );