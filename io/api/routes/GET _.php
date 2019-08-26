<?php

route::get ( '/', function ( )
{
    list ( $code, $payload ) = app::make ( 'i want to see my habits', [ 'user' => app::make ( 'active user' ) ] );    
    return app::call ( status::match ( $code ), $payload );
} );