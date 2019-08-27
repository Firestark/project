<?php

namespace firestark;

use closure;

class testcase
{
    public $feature = '';
    public $description = '';
    public $test = null;

    public function __construct ( string $feature, string $description, closure $test )
    {
        $this->feature = $feature;
        $this->description = $description;
        $this->test = $test;
    }
}