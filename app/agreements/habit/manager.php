<?php

namespace habit;

use user;

interface manager
{
    function allFor ( user $user ) : array;
}