<?php

testing::feature ( 'i want to see my habits', function ( )
{    
    testcase::add ( 'registered user', function ( $app )
    {
        $app [ 'habit manager all for' ];

        list ( $status ) = $app->make ( 'i want to see my habits', [
            'habitManager' => $app [ 'habit manager' ],
            'user' => $app [ 'registered user' ],
            'userManager' => $app [ 'user manager' ]
        ] );

        assertThat ( $status, is ( 1000 ) );
    } );

    testcase::add ( 'unregistered user', function ( $app )
    {
        list ( $status ) = app::make ( 'i want to see my habits', [
            'habitManager' => $app [ 'habit manager' ],
            'user' => $app [ 'unregistered user' ],
            'userManager' => $app [ 'user manager' ]
        ] );

        assertThat ( $status, is ( 0 ) );
    } );
} );