# Routing

A route has the responsibility to match an HTTP request and turn that into an HTTP response. A route **must** always return an HTTP response.



All files inside the `/io/api/routes` and `/io/web/routes` directories are automatically included. This means you can create as many `.php` files as you want inside the `/io/api/routes` and `/io/web/routes` directories and nested directories to define your routes.

## Defining routes

```php

route::get ( '/', function ( )
{
    return new http\response ( 'Hello' );
} );

route::post ( '/', function ( )
{
    return new http\response ( 'Hello' );
} );

route::get ( '/{id}', function ( $id )
{
	return new http\response ( ( string ) $id );
} );

```



### Route parameters

```php

route::get ( '/{name}', function ( string $name )
{
	return new http\response ( 'Hello ' . $name );
} );

```

The {name} pattern gets put into the parameter $name inside the closure.


```php

route::get ( '/{id}/{name}', function ( $name, $id )
{
	return new http\response (  );
} );

```

**Watch out**: The order of provided parameters is maintained. For the example above this means the {id} part is assigned to $name and the {name} part is assigned to $id.

### Input

Route parameters are automatically made available as request input.

```php
route::get ( '/{id}', function ( $id )
{

} );
```

>  With the route defined in the example above and a request of `GET /my-id` means `input::get ( 'id' ) === 'my-id'`.

