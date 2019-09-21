<?php

class flatfileUserManager
{
    public $users = [ ];

    function __construct ( array $users )
    {
        $this->users = $users;
    }

    function add ( user $user )
    {
        foreach ( $this->users as $stored )
            if ( $stored->username === $user->username )
                return;

        $this->users [ ] = $user;
    }

    function remove ( user $user )
    {
        unset ( $this->users [ $user->username ] );
    }
}