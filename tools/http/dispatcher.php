<?php

namespace firestark\http;

use closure;
use FastRoute\DataGenerator\GroupCountBased as generator;
use FastRoute\Dispatcher\GroupCountBased as base;
use FastRoute\RouteCollector as router;
use FastRoute\RouteParser\Std as parser;

class dispatcher extends base
{
	private $router = null;

	public function __construct ( array $routes )
	{
		$this->router = new router (
		  	new parser,
		  	new generator
		);

		foreach ( $this->sort ( $routes ) as $route )
			$this->router->addRoute ( $route->method, $route->path, $route->task );

		parent::__construct ( $this->router->getData ( ) );
	}

	public function match ( string $method, string $uri )
	{
		$result = parent::dispatch ( $method, $uri );
		return $this->handle ( $result, $method, $uri );
	}

	protected function notFound ( string $method, string $path )
	{
		throw new exception ( 404, "`{$method} {$path}` can not be handled, there is no route defined for it. Did you forget to add a `/` at the end of the url?" );
	}

	protected function notAllowed ( string $method, string $path )
    {
        throw new exception ( 405, "`{$method}` is not allowed for `{$path}`." );
    }

	private function decoded ( array $arguments ) : array
    {
        foreach ( $arguments as $key => $value )
            $return [ $key ] = urldecode ( $value );
        return ( $return ) ?? [ ];
    }

	private function handle ( array $result, string $method, string $path ) : array
	{
		if ( $result [ 0 ] === 1 )
			return [ $result [ 1 ], $this->decoded ( $result [ 2 ] ) ];

		if ( $result [ 0 ] === 2 )
			$this->notAllowed ( $method, $path );

		if ( $result [ 0 ] === 0 )
			$this->notFound ( $method, $path );
	}

	private function sort ( array $routes ) : array
	{
		usort ( $routes, function ( route $a, route $b )
		{
			return strcasecmp ( $a->uri , $b->uri ); 
		} );
		
		return $routes;
	}
}