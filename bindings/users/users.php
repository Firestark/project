<?php

app::share ( 'users', function ( $app )
{
	$users = unserialize ( file_get_contents ( $app [ 'users file' ] ) );

	if ( ! is_array ( $users ) )
		$users = [ ];

	return $users;
} );
