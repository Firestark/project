# Bindings

Bindings are a map of key, value pairs we register inside the application. The key can be any string you like. The value is a closure that returns any value you want. Whenever you resolve the key from the application you will get the value that the closure returns. 

One of the major use cases of bindings are resolving the procedure parameters inside the business logic. Whenever the application encounters a type hinted class parameter it will look into it's bindings for a key of that type hinted full class-name. This is the way we provide the procedures the parameters it needs.

Bindings make it possible to use services for agreements by binding the agreement class name to a service. Example 1 below shows that. 



Bindings are located inside the `/client/bindings` directory and are automatically included inside your application. This means you can name your bindings any way you like as long as they have the `.php` suffix and are placed inside the `/client/bindings` or any nested directory.

## Examples

```php
<?php

app::bind ( todo\manager::class, function ( $app )
{
    return new flatfileTodoManager ( 
        $app [ 'todos file' ],
        $app [ 'todos' ]
    );
} );
```

> Example 1: Binding a todo manager



In example 1 we bind the `\todo\manager` class to return a `flatfileTodoManager`. Whenever we ask for a `todo\manager` we will get the flat file todo manager. 



## Resolving bindings

