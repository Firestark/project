<?php

route::get ( '/', function ( )
{
    list ( $code, $payload ) = app::make ( 'i want to see my habits' );    
    return app::call ( status::match ( $code ), $payload );
} );