<?php

use user\credentials;

class user
{
    public $credentials;

    function __construct ( credentials $credentials )
    {
        $this->credentials = $credentials;
    }
}