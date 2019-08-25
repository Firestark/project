<?php

namespace firestark\http;

use closure;

class router
{
	use \accessible;

	protected $routes = [ ];

    public function get ( string $uri, closure $task )
    {
        $this->add ( new route ( 'GET ' . $uri, $task ) );
    }

    public function post ( string $uri, closure $task )
    {
        $this->add ( new route ( 'POST ' . $uri, $task ) );
    }

    public function put ( string $uri, closure $task )
    {
        $this->add ( new route ( 'PUT ' . $uri, $task ) );
    }

    public function delete ( string $uri, closure $task )
    {
        $this->add ( new route ( 'DELETE '. $uri, $task ) );
    }

	public function add ( route $route )
	{
        $this->routes [ $route->uri ] = $route;
	}

	public function has ( string $uri ) : bool
	{
		return array_key_exists ( $uri, $this->routes );
	}
}