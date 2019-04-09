<?php

route::get ( '/', function ( )
{
    return view::ok ( 'welcome' );
} );