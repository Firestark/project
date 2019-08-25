<?php

namespace user;

use user;

interface manager
{
    function register ( user $user );

    function registered ( user $user ) : bool;

    function has ( string $username ) : bool;
}