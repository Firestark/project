<?php

when ( 'i want to add a habit', then ( apply ( a ( 
    
function ( user $user, guard $guard, habit $habit, habit\manager $habitManager )
{
    $guard->authenticate ( $user );
    $habits = $habitManager->all ( );
    $habits [ ] = $habit;

    return [ -1, [ 'habits' => $habits ] ];
} ) ) ) );