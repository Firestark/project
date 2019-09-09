<?php

when ( 'i want to update a habit', then ( apply ( a ( 
    
function ( user $user, guard $guard, habit $old, habit $new, habit\manager $habitManager )
{
    $guard->authenticate ( $user );
    $habitManager->update ( $old, $new );
    return [ 0, [ 'habits' => $habitManager->all ( ) ] ];
} ) ) ) );