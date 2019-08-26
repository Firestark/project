<?php

status::matching ( 0, function ( )
{
    if ( empty ( app::make ( 'token' ) ) )
        $message = 'No token found, please provide a token in the request Authorization header';
    else
        $message = 'The given token is invalid';

    return response::unauthorized ( 0, $message );
} );