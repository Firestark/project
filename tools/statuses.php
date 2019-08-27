<?php

namespace firestark;

use closure;


class statuses
{
    private $matched = [ ];

    public function match ( $status ) : closure
    {        
        if ( ! $this->matches ( $status ) )
            throw new \runtimeException ( "The status code: {$status} has not been matched." );

        return $this->matched [ $status ];
    }

    public function matching ( $status, closure $callback )
    {        
        if ( $this->matches ( $status ) )
            throw new \runtimeException ( "The status code: {$status} has already been matched." );

        $this->matched [ $status ] = $callback;
    }

    public function matches ( $status ) : bool
    {
        return ( array_key_exists ( $status, $this->matched ) ) ;
    }
}
