<?php

namespace Firestark;

use League\Route\Route;
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};

class Router extends \League\Route\Router
{
    public function dispatch(ServerRequestInterface $request): ResponseInterface
    {
        $this->routes = $this->sort($this->routes);
        return parent::dispatch($request);
    }

    private function sort(array $routes): array
	{
		usort($routes, function (Route $a, Route $b)
		{
			return strcasecmp($a->getPath() , $b->getPath()); 
		} );
		
		return $routes;
	}
}
