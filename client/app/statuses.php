<?php

namespace firestark;

use closure;


class statuses
{
    private $matched = [ ];

    public function match ( int $status ) : closure
    {
        if ( ! $this->matches ( $status ) )
            throw new \runtimeException ( "The status code: $status has not been matched." );

        return $this->matched [ $status ];
    }

    public function matching ( int $status, closure $callback )
    {
        if ( $this->matches ( $status ) )
            throw new \runtimeException ( "The status code: $status has already been matched." );

        $this->matched [ $status ] = $callback;
    }

    public function matches ( int $status ) : bool
    {
        return ( array_key_exists ( $status, $this->matched ) ) ;
    }
}
