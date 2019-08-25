<?php

use user\credentials;

interface guard
{
    function stamp ( credentials $credentials ) : string;

    function read ( string $token ) : credentials;
}