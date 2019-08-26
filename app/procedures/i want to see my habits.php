<?php

use function compact as with;

when ( 'i want to see my habits', then ( apply ( a ( 
    
function ( habit\manager $manager, user $user, user\manager $userManager )
{
    if ( ! $userManager->registered ( $user ) )
        return [ 0, with ( 'user' ) ];

    return [ 1000, [ 'habits' => $manager->allFor ( $user ) ] ];
} ) ) ) );
