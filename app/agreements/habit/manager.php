<?php

namespace habit;

use habit;

interface manager
{
    function has ( habit $habit ) : bool;

    function add ( habit $habit );

    function all ( ) : array;

    function complete ( habit $habit );

    function remove ( habit $habit );
}