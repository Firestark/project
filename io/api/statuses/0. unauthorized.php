<?php

status::matching ( 0, function ( )
{
    return response::unauthorized ( 0, 'Unauthorized request' );
} );