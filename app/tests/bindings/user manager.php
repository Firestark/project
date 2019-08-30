<?php

app::share ( 'user manager', function ( $app )
{
    return mockery::mock ( user\manager::class );
} );
