<?php

namespace habit;

use habit;
use user;

interface manager
{
    function allFor ( user $user ) : array;

    function add ( habit $habit, user $user );

    function hasTitle ( string $title, user $user ) : bool;
}