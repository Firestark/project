<?php

route::get ( '/', function ( )
{
    return response::ok ( 1, 'test' );
} );