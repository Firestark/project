# Facades

A facade is a class that provides easy access to an object inside the application. Facades should only be used inside the implementation layer and used with care because they essentially are like a global variable.  Facades are really useful in situations where we want access to technical components but don't directly have an instance of that technical component available to us.

## How facades work

All components are registered under a name inside the application using bindings. Whenever you call a static method on a facade, that facade uses the ``getFacadeAccessor`` method to resolve the component out of the application using a binding. The application than forwards the static method call to that resolved component like calling a normal method on an instance.



```php
class view extends facade
{
    public static function getFacadeAccessor ( )
    {
        return 'view';
    }
}
```

> This example shows a view facade. The `getFacadeAccessor` method resolves a binding under the string key `'view'`. The resolved value should be an instance of a class, in this case presumably a view engine. calling static methods on the view facade delegates them onto the resolved view engine instance. An example in this case is: `view::make ( 'test' )` which resolves to calling the make method on the view engine instance.

## Creating your own facades

All facades are located inside the ``/facades`` directory and are automatically loaded into the global namespace by composer. You create a facade by creating a class inside the `/facades` directory and extending the `\facade` class. You have to implement the `getFacadeAccessor` method which must return a string. That string is the key of the binding you want to create a facade for.



```php
class route extends facade
{
    public static function getFacadeAccessor ( )
    {
        return 'router';
    }
}
```

> Here we create the route facade. The `getFacadeAccessor` method returns the string `'router'` which is the key of the binding that resolves the router instance. With this facade we can call the router class methods as static methods via the facade. The following is an example that calls the get method on the router instance: `route::get ( '/', function ( ) { } );`