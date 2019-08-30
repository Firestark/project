<?php

namespace firestark;

use closure;
use ioc\container;

class app extends container
{
    function assumption ( string $abstract, closure $concrete )
    {
        $this->bind ( $abstract, $concrete );
    }
}