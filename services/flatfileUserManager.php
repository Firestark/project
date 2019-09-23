<?php

class flatfileUserManager implements user\manager
{
    public $users = [ ];
    private $file = '';

    function __construct ( array $users, string $file )
    {
        $this->users = $users;
        $this->file = $file;
    }

    function add ( user $user )
    {
        foreach ( $this->users as $stored )
            if ( $stored->username === $user->username )
                throw new exception ( "A user with username: {$user->username} already exists." );

        $this->users [ $user->username ] = $user;
        $this->write ( );
    }

    function has ( user $user ) : bool
    {
        return 
            $this->registered ( $user ) and
            $this->users [ $user->username ]->password === $user->password;
    }

    function registered ( user $user ) : bool
    {
        return isset ( $this->users [ $user->username ] );
    }

    function remove ( user $user )
    {
        unset ( $this->users [ $user->username ] );
        $this->write ( );
    }

    private function write ( )
    {
        file_put_contents ( $this->file, serialize ( $this->users ) );
    }
}