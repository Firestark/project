<?php

testing::feature ( 'i want to add a habit', function ( )
{
    testcase::add ( 'registered user, unused habit title', function ( $app )
    {
        $app [ 'habit manager has title returns false' ];
        $app [ 'habit manager add' ];


        list ( $status ) = $app->make ( 'i want to add a habit', [
            'habit' => $app [ 'habit' ],
            'habitManager' => $app [ 'habit manager' ],
            'user' => $app [ 'registered user' ],
            'userManager' => $app [ 'user manager' ]
        ] );

        assertThat ( $status, is ( 1001 ) );
    } );
} );


