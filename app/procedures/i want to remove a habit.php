<?php

when ( 'i want to remove a habit', then ( apply ( a ( 
    
function ( $id, habit\manager $habitManager, user $user )
{
    // i need to know wether this habit is from the user...
    $habitManager->remove ( $id, $user );
} ) ) ) );