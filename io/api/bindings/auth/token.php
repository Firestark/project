<?php

app::bind ( 'token', function ( $app ) : string
{
    return $app [ 'request' ]->getHeaderLine ( 'Authorization' );
} );
