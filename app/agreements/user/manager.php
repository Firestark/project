<?php

namespace user;

use user;

interface manager
{
    function add ( user $user );

    function remove ( user $user );

    function has ( user $user ) : bool;
}