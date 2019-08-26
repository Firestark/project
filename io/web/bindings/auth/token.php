<?php

app::bind ( 'token', function ( $app ) : string
{
    return $app [ 'session' ]->get ( 'Authorization', '' );
} );
