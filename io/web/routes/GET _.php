<?php

route::get ( '/', function ( )
{
    return response::ok ( 'test' );
} );