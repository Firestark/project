<?php

route::post ( '/', function ( )
{
    list ( $code, $payload ) = app::make ( 'i want to add a habit', [ 'user' => app::make ( 'active user' ) ] );
    return app::call ( status::match ( $code ), $payload );
} );