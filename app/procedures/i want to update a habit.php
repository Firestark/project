<?php

when ( 'i want to update a habit', then ( apply ( a ( 
    
function ( user $user, guard $guard, habit $old, habit $new, habit\manager $habitManager )
{
    if ( ! $guard->authenticate ( $user ) )
        return [ 0, [ ] ];
    
    if ( $habitManager->has ( $new ) )
        return [ 2000, [ 'habit' => $new ] ];

    $habitManager->update ( $old, $new );
    return [ 0, [ 'habits' => $habitManager->all ( ) ] ];
} ) ) ) );