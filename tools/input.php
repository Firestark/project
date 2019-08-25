<?php

namespace Firestark;

class input
{
    private $_data = [ ];

    public function __construct ( array $data )
    {
        $this->_data = $data;
    }

    public function all ( ): array
    {
        return $this->_data;
    }

    public function get ( string $key, $default = null )
    {
        return $this->_data [ $key ] ?? $default;
    }
}