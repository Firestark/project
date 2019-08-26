<?php

route::post ( '/', function ( )
{
    list ( $code, $payload ) = app::make ( 'i want to add a habit' );
    return app::call ( status::match ( $code ), $payload );
} );