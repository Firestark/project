<?php

namespace user;

class credentials
{
    public $username, $password;

    function __construct ( string $username, string $password )
    {
        $this->username = $username;
        $this->password = hash ( 'sha256', $password );
    }
}