<?php

when ( 'i want to remove a habit', then ( apply ( a ( 
    
function ( user $user, guard $guard, habit $habit, habit\manager $habitManager )
{
    if ( ! $guard->authenticate ( $user ) )
        return [ 0, [ ] ];

    $habitManager->remove ( $habit );
    
    return [ -1, [ 'habits' => [ ] ] ];
} ) ) ) );