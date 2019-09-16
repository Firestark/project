<?php

class user
{
    function __construct ( string $username, string $password )
    {
        $this->username = $username;
        $this->password = hash ( 'sha256', $password );
    }
}