<?php

app::bind ( habit::class, function ( ) 
{
    return new habit (
        input::get ( 'id', uniqid ( ) ),
        input::get ( 'title', '' )
    );
} );