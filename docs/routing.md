# Routing

```php

route::get ( '/', function ( )
{
    
} );

route::post ( '/', function ( )
{
    
} );

route::get ( '/{id}', function ( $id )
{

} );

```


All files inside the ``/client/routes`` directory are automatically included. This means you can create as many php files as you want inside this ``/client/routes`` directory to define your routes.

## Route parameters

```php

route::get ( '/{id}', function ( $id )
{

} );

```

The {id} pattern gets put into the parameter $id inside the closure.


```php

route::get ( '/{id}/{name}', function ( $name, $id )
{

} );

```

Watch out: The order of provided parameters is maintained. For the example above this means the {id} part is assigned to $name and the {name} part is assigned to $id.


## Input

```php

route::get ( '/{id}', function ( $id )
{

} );

```

Route parameters are automatically made available as request input. With the route defined in above example and a request with uri GET /my-id 
Means input::get ( 'id' ) === "my-id".
