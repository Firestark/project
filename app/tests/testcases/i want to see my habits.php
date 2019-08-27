<?php

use function compact as with;

test::add ( 
    'i want to see my habits',
    'Using a saturated habit manager and a valid user should return status code 1000.',

function ( habit\manager $habitManager, user $user, user\manager $userManager )
{
    list ( $status, $payload ) 
        = app::make ( 'i want to see my habits', with ( 'habitManager', 'user', 'userManager' ) );

    assertThat ( $status, is ( identicalTo ( 1000 ) ) );
} );


test::add ( 
    'i want to see my habits',
    'Using a saturated habit manager and a valid user should return the correct payload.',

function ( habit\manager $habitManager, user $user, user\manager $userManager )
{
    list ( $status, $payload ) 
        = app::make ( 'i want to see my habits', with ( 'habitManager', 'user', 'userManager' ) );

    assertThat ( $payload, is ( identicalTo ( [ 'habits' => app::make ( 'habits' ) ] ) ) );
} );