<?php

route::get ( '/', function ( )
{
    dd ( 'here' );
    return app::fulfill ( 'i want to see my todos' );
} );