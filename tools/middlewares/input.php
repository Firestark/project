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
        if ( $request->getHeaderLine ( 'Content-Type' ) === 'application/json' )
            $data = $this->parseJson ( $request );
        else
            $data = $this->parseForm ( $request );
        
        $this->app->instance ( 'input', new \firestark\input ( $data ) );
        return $handler->handle ( $request ); 
    }

    private function parseForm ( request $request ) : array
    {
        parse_str ( $request->getUri ( )->getQuery ( ), $query );
        parse_str ( ( string ) $request->getBody ( ), $post );

        return array_merge ( $post, $query );
    }

    private function parseJson ( request $request ) : array
    {
        $query = ( array ) json_decode ( $request->getUri ( )->getQuery ( ) );
        $post = ( array ) json_decode ( $request->getBody ( ) );

        return array_merge ( $post, $query );
    }
}

