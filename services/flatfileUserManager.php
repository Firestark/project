<?php

use firestark\credentials;
use firestark\userManager;

class flatfileUserManager implements user\manager
{
    private $users = [ ];
    private $file = '';

    function __construct ( string $file, array $users )
    {
        $this->file = $file;
        $this->users = $users;
    }

    function register ( user $user )
    {        
        $this->users [ $user->credentials->username ] = $user;
        $this->write ( );
    }

    function registered ( user $user ) : bool
    {
        $username = $user->credentials->username;

        return ( 
            isset ( $this->users [ $username ] ) && 
            $this->users [ $username ]->credentials->password === $user->credentials->password
        );
    }

    function has ( string $username ) : bool
    {
        return isset ( $this->users [ $username ] );
    }

    private function write ( )
	{
		file_put_contents ( $this->file, serialize ( $this->users ) );
    }
}