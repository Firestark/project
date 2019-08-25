<?php

effect::matching ( 1000, 

function ( user $user, habit\manager $habits ) : array
{
    return $habits->allFor ( $user );
} );