<?php

use firestark\userManager;

app::share ( user\manager::class, function ( $app )
{
    return new flatfileUserManager (
        $app [ 'users file' ],
        $app [ 'users' ] );
} );