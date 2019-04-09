<?php

namespace firestark;

use ioc\container;
use function compact as with;


class app extends container
{
    public function fulfill ( string $request, array $payload = [ ] ) : response
    {
        list ( $status, $body ) = $this->make ( $request, $payload );
        $response = $this->call ( $this [ 'statuses' ]->match ( $status ), $body );
        $response->status ( $status );
        return $response;
    }
}