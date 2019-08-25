<?php

namespace firestark\http;

use Psr\Http\Message\ResponseInterface as response;
use Zend\Diactoros\Response\RedirectResponse as redirectResponse;

class redirector
{
    private $previous = '/';

    public function __construct ( string $previous )
    {
        $this->previous = $previous;
    }

    public function to ( string $uri ) : response
    {
        return new redirectResponse ( $uri );
    }

    public function back ( ) : response
    {
        return new redirectResponse ( $this->previous );
    }
}