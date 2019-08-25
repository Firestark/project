<?php

namespace firestark\middlewares;

use firestark\app;
use firestark\http\redirector;
use Psr\Http\Message\ResponseInterface as response;
use Psr\Http\Message\ServerRequestInterface as request;
use Psr\Http\Server\RequestHandlerInterface as handler;
use Psr\Http\Server\MiddlewareInterface as middleware;

class redirect implements middleware
{
    private $app = null;
    
    public function __construct ( app $app )
    {
        $this->app = $app;
    }
    
    public function process ( request $request, handler $handler ) : response
    {
        $previousUri = $this->app [ 'session' ]->get ( 'previous-uri', '/' );
        $this->app->instance ( 'redirector', new redirector ( $previousUri ) );
        $response = $handler->handle ( $request );
        $this->app [ 'session' ]->flash ( 'previous-uri', $this->app [ 'request' ]->getUri ( )->getPath ( ) . '?' . $request->getUri ( )->getQuery ( ) );
        return $response;
    }
}

