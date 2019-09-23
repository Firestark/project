<?php

app::share ( user\manager::class, function ( )
{
    $file = __DIR__ . '/../../storage/databases/files/users.data';
    $users = unserialize ( file_get_contents ( $file ) );

    if ( ! is_array ( $users ) )
        $users = [ ];

    return new flatfileUserManager ( $users, $file );
} );