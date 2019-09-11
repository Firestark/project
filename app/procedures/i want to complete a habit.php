<?php

when ( 'i want to complete a habit', then ( apply ( a ( 
    
function ( user $user, guard $guard, habit $habit, habit\manager $habitManager )
{
    if ( ! $guard->authenticate ( $user ) )
        return [ 0, [ ] ];

    if ( ! $habitManager->has ( $habit ) )
        return [ 2001, [ ] ];

    $habitManager->complete ( $habit );
    return [ 1002, [ 'habit' => $habit ] ];
} ) ) ) );