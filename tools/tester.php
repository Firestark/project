<?php

namespace firestark;

use closure;

class tester
{
    public $tests = [ ];
    
    function add ( string $feature, string $description, closure $test )
    {
        $this->tests [ ] = new testcase ( $feature, $description, $test );
    } 
}