<?php

app::bind ( user\credentials::class, function ( $app )
{
    if ( ! empty ( $app [ 'token' ] ) )
        return $app [ 'guard' ]->read ( $app [ 'token' ] );

    return new user\credentials (
        input::get ( 'username', '' ),
        input::get ( 'password', '' )
    );
} );
