<?php

app::share ( 'users file', function ( $app )
{
	return __DIR__ . '/../../storage/databases/files/users.data';
} );
