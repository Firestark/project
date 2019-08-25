<?php

route::get ( '/', function ( )
{
    list ( $code, $payload ) = app::make ( 'i want to see my habits' );
    
    if ( effect::matches ( $code ) )
        $payload = app::call ( effect::match ( $code ), $payload );
    
    return app::call ( status::match ( $code ), $payload );
} );