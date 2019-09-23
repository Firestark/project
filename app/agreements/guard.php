<?php

class guard
{
    private $userManager = null;

    function __construct ( user\manager $userManager )
    {
        $this->userManager = $userManager;
    }

    function authenticate ( user $user ) : bool
    {
        return $this->userManager->has ( $user );
    }
}