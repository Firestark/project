<?php

namespace firestark\middlewares;

use firestark\app;
use Psr\Http\Message\ResponseInterface as response;
use Psr\Http\Message\ServerRequestInterface as request;
use Psr\Http\Server\RequestHandlerInterface as handler;
use Psr\Http\Server\MiddlewareInterface as middleware;

class input implements middleware
{
    private $app = null;
    
    public function __construct ( app $app )
    {
        $this->app = $app;
    }
    
    public function process ( request $request, handler $handler ) : response
    {
        parse_str ( $request->getUri ( )->getQuery ( ), $query );
        parse_str ( ( string ) $request->getBody ( ), $post );
        
        $this->app->instance ( 'input', new \firestark\input ( array_merge ( $query, $post ) ) );
        return $handler->handle ( $request ); 
    }
}

