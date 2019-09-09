<?php

use function compact as with;

when ( 'i want to add a habit', then ( apply ( a ( 
    
function ( user $user, guard $guard, habit $habit, habit\manager $habitManager )
{
    if ( ! $guard->authenticate ( $user ) )
        return [ 0, [ ] ];

    if ( $habitManager->has ( $habit ) )
        return [ 2000, with ( 'habit' ) ];
    
    $habitManager->add ( $habit );
    return [ 1001, [ 'habits' => $habitManager->all ( ) ] ];
} ) ) ) );