<?php

when ( 'i want to see my habits', then ( apply ( a ( 
    
function ( user $user, guard $guard, habit\manager $habitManager )
{
    if ( ! $guard->authenticate ( $user ) )
        return [ 0, [ ] ];

    return [ 1000, [ 'habits' => $habitManager->all ( ) ] ];
} ) ) ) );