# Bindings

Bindings are a map of key, value pairs we register inside the application. The key can be any string you like. The value is a closure that returns any value you want. Whenever you resolve the key from the application you will get the value that the closure returns. 

One of the major use-cases of bindings is resolving procedure parameters inside the business logic. Whenever the application encounters a type hinted class parameter it will look into it's bindings for a string key that matches that type hinted class-name. If it finds that class-name in it's bindings it resolves the binding registered with that class-name. With this functionality we provide the procedures the parameters it needs.

Bindings also make it possible to use services for agreements by binding the agreement class-name to a service. This makes it so whenever the business logic asks for an instance of an agreement the implementation layer will provide the bound service.



### Global bindings

Firestark is split up in multiple different IO channels. Global bindings are bindings used for every IO channel. When you place a binding under the `/bindings` directory that binding is used for every IO channel.

### IO specific bindings

Firestark is split up in multiple different IO channels. Each IO channel can have bindings specifically for that channel. Whenever you place a binding under the `/io/*/bindings` directory it will register that binding only for that specific IO channel.



## Creating bindings

All bindings placed inside the `/bindings` or `/io/*/bindings` directories are automatically included inside your application. This means you can name your bindings any way you like as long as they have the `.php` suffix and are placed inside these directories.

### Normal binding

```php
app::bind ( todo::class, function ( $app )
{
    return new todo ( uniqid ( ), 'hello world' );
} );
```

> Example 1: Binding a todo

In example 1 the todo class gets bound. Whenever we ask the application for a todo it will create one with `uniqid` and the string `'hello world'`.

### Shared binding

Shared binding only get resolved once. Whenever you ask for a shared binding the application will look if it already created that binding before and return that if it exists.

```php
app::share ( todo\manager::class, function ( $app )
{
    return new flatfileTodoManager ( 
        $app [ 'todos file' ],
        $app [ 'todos' ]
    );
} );
```

> Example 2: Shared binding



Bindings don't have to return a class they can be used to bind any value

```php
app::share ( 'todos file', function ( $app )
{
    $directory = __DIR__ . '/../storage/db/files/';
    $file = 'todos.data';
    return $directory . '/' . $file;
} );
```

> Example 3: Binding a string



### Binding with parameters

```php
app::bind ( todo::class, function ( $app, array $parameters )
{
	//
} );
```

> Example 4: A binding with parameters



## Resolving bindings

### automatic resolving

Bindings are automatically resolved when executing a procedure.

### Manual resolving

Bindings can be manually resolved by using the make method on the app facade.

```php
app::make ( todo\manager::class );
```

When the binding expects some parameters they can be provided as an array to the second argument of the make method.

```php
app::make ( todo::class, [ 'id' => 123 ] );
```