<?php

namespace habit;

use habit;
use user;

interface manager
{
    function allFor ( user $user ) : array;

    function add ( habit $habit, user $user );

    function has ( habit $habit, user $user ) : bool;
}