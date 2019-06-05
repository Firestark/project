# Facades

A facade is a class that provides easy access to an object inside the application. All facades are located inside the ``/client/facades`` directory.

```php

class route extends facade
{
    public static function getFacadeAccessor ( )
    {
        return 'router';
    }
}

```

The ``getFacadeAccessor`` function returns the name under which the implementation is registered inside the application.
The above facade makes it so we can access the router like so:


```php

route::get ( '/', function ( ) { } );

```

