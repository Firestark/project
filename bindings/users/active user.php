<?php

app::share ( activeUser::class, function ( $app )
{
    if ( empty ( $app [ 'token' ] ) )
        throw new exception ( 'Can\'t find a token to create an active user' );

    $credentials = $app [ 'guard' ]->read ( $app [ 'token' ] );
    return new activeUser ( $credentials );
} );