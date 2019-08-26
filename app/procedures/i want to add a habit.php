<?php

use function compact as with;

when ( 'i want to add a habit', then ( apply ( a ( 
    
function ( habit $habit, habit\manager $habitManager, activeUser $user, user\manager $userManager )
{
    if ( ! $userManager->registered ( $user ) )
        return [ 0, with ( 'user' ) ];

    if ( $habitManager->has ( $habit, $user ) )
        return [ 2000, [ ] ];
        
    $habitManager->add ( $habit, $user );
    return [ 1001, with ( 'habit', 'user' ) ];
} ) ) ) );