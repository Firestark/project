<?php

use function compact as with;

when ( 'i want to add a habit', then ( apply ( a ( 
    
function ( habit $habit, habit\manager $habitManager, user $user, user\manager $userManager )
{
    if ( ! $userManager->registered ( $user ) )
        return [ 0, [ ] ];

    if ( $habitManager->has ( $habit ) )
        return [ 2000, [ ] ];
        
    return [ 1001, with ( 'habit', 'user' ) ];
} ) ) ) );