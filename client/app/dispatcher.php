<?php

namespace firestark;

class dispatcher extends \http\dispatcher
{
    public function match ( string $method, string $uri )
    {
        if ( defined ( 'BASEURL' ) )
            $uri = str_replace ( BASEURL, '', $uri );

        return parent::match ( $method, $uri );
    }
}