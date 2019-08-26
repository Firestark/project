<?php

app::share ( 'active user', function ( $app )
{
    $credentials = $app [ 'guard' ]->read ( $app [ 'token' ] );
    return new user ( $credentials );
} );