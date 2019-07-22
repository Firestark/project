# Bindings

Bindings are a map of key, value pairs we register inside the application. The key can be any string you like. The value is a closure that returns any value you want. Whenever you resolve the key from the application you will get the value that the closure returns. 

One of the major use-cases of bindings is resolving procedure parameters inside the business logic. Whenever the application encounters a type hinted class parameter it will look into it's bindings for a string key that matches that type hinted class-name. If it finds that class-name in it's bindings it resolves the binding registered with that class-name. With this functionality we provide the procedures the parameters it needs.

Bindings also make it possible to use services as agreement implementations by binding the agreement class-name to a service. This makes it so that whenever the business logic asks for an instance of an agreement the implementation layer will provide the bound service.



### Global bindings

Firestark is split up in multiple different IO (input output) channels. Global bindings are bindings used for every IO channel. When you place a binding under the `/bindings` directory that binding is used for every IO channel.

### IO specific bindings

Firestark is split up in multiple different IO channels. Each IO channel can have bindings specifically for that channel. Whenever you place a binding under the `/io/*/bindings` directory it will register that binding only for that specific IO channel.



## Creating bindings

All bindings placed inside the `/bindings` and`/io/*/bindings` directories are automatically included inside your application. This means you can name your bindings any way you like as long as they have the `.php` suffix and are placed inside the `/bindings` and`/io/*/bindings` directories.

### Normal binding

```php
app::bind ( todo::class, function ( )
{
    return new todo ( uniqid ( ), 'hello world' );
} );
```

> In this example the todo class gets bound. Whenever we ask the application for a todo it will create an instance of the \todo class with `uniqid` and the string `'hello world'`.

### Shared binding

Shared bindings are only resolved once. The first time the application is asked for a shared binding it will resolve it and then remember the result. On subsequent requests for that binding the remembered result will be returned.



```php
app::share ( todo\manager::class, function ( )
{
    return new flatfileTodoManager ( 
        $app [ 'todos file' ],
        $app [ 'todos' ]
    );
} );
```

> The first time we ask the application for the `todo\manager` it uses the closure to create an instance of the `flatfileTodoManager` and remembers that instance. On following requests for the `todo\manager` we will get that remembered `flatfileTodoManager` without resolving it again from the closure.



Bindings don't have to return a class they can be used to bind any value

```php
app::share ( 'todos file', function ( )
{
    $directory = __DIR__ . '/../storage/db/files/';
    $file = 'todos.data';
    return $directory . '/' . $file;
} );
```



### Binding using other bindings

You can use other bindings inside a binding. The first parameter to the closure is an instance of the application from which you can resolve other bindings. You can use the array notation (` $app [ 'my binding' ]`) or the make method (`$app->make ( 'my binding' `)  to resolve other bindings.

```php
app::bind ( todo\manager::class, function ( $app )
{
	return new flatFileTodoManager ( 
        $app [ 'todos file' ],
        $app [ 'todos' ]
    );    
} );
```



### Binding with parameters

Optionally you can use parameters as an array inside the binding. The parameters are provided when you use the make method with as second argument an array as shown in the example below.

```php
app::bind ( todo::class, function ( $app, array $parameters )
{
	var_dump ( $parameters ); // array [ 'id' => 12345 ]
} );

// To provide parameters

app::make ( todo::class, [ 'id' => 12345 ] );
```



### Instance binding

You can bind an existing instance into the container with the instance method like so:

```php
app::instance ( 'view', new view );
```

## Resolving bindings

### automatic resolving

Bindings are automatically resolved when executing a procedure.

### Manual resolving

Bindings can be manually resolved by using the make method on the app facade or the array notation on the $app instance:

```php
app::make ( todo\manager::class );

app [ todo\manager::class ];
```

When the binding expects some parameters they can be provided as an array to the second argument of the make method.

```php
app::make ( todo::class, [ 'id' => 123 ] );
```

