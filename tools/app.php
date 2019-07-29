<?php

namespace Firestark;

use Illuminate\Container\Container;

class App extends Container
{
    public function binding(string $abstract, \closure $concrete)
    {
        $concrete = function ($container, array $parameters = []) use ($concrete)
		{
			return $container->call($concrete, $parameters);
		};

		$this->bind($abstract, $concrete);
    }

    public function share(string $abstract, \closure $concrete)
	{
		$this->bind($abstract, $concrete, true);
	}
}