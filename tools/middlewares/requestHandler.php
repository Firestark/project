<?php

namespace firestark\middlewares;

use firestark\http\dispatcher;
use Psr\Http\Message\ResponseInterface as response;
use Psr\Http\Message\ServerRequestInterface as request;
use Psr\Http\Server\RequestHandlerInterface as handler;
use Psr\Http\Server\MiddlewareInterface as middleware;

class requestHandler implements middleware
{
    private $dispatcher = null;
    
    public function __construct ( dispatcher $dispatcher )
    {
        $this->dispatcher = $dispatcher;
    }
    
    public function process ( request $request, handler $handler ) : response
    {
        list ( $task, $arguments ) = $this->dispatcher->match ( 
            $request->getMethod ( ), 
            $request->getUri ( )->getPath ( ) 
        );

        return call_user_func_array ( $task, $arguments );
    }
}

