# Services

Agreements inside the business logic may know nothing about technical details. An example limitation of this is that agreements can not directly talk to a database. To still be able to store changes in a database we create a service inside the implementation layer that extends or implements the agreement. This service can talk to a database to store changes. As you can see, services have the role of taking an abstraction (the agreement) from the business logic and create a concrete implementation of that abstraction.



## Creating services

Services are placed inside the `/services` directory and this directory is automatically loaded into the global namespace by composer.

### Agreement

```php
<?php
    
namespace todo;

use todo;

interface manager
{
    function find ( $id ) : todo;
    
    function add ( todo $todo );
    
    function edit ( todo $todo );
    
    function remove ( todo $todo );
}
```

> This is an example of an agreement out of the business logic. On it's own it cannot be used, we need to create an implementation that implements this agreement, which we call a service. You can see this service below.



### Implementation

```php
class flatfileTodoManager implements todo\manager
{
    private $todos = [ ];
    private $file = '';

    function __construct ( string $file, array $todos )
    {
        $this->file = $file;
        $this->todos = $todos;
    }
    
    function find ( $id ) : todo
    {
        return $this->todos [ $id ];
    }

    function add ( todo $todo )
    {
        $this->todos [ $todo->id ] = $todo;
        $this->write ( );
    }

    function edit ( todo $todo )
    {
        $this->todos [ $todo->id ] = $todo;
        $this->write ( );
    }

    function remove ( todo $todo ) : bool
    {
        unset ( $this->todos [ $todo->id ] );
        $this->write ( );
    }

    private function write ( )
	{
		file_put_contents ( $this->file, serialize ( $this->todos ) );
    }
}
```

> This is an implementation of the agreement we saw in the previous code example. We call this implementation a service. It should be placed inside the `/services` directory. In this case we have chosen to store the data in a file, hence the name `flatfileTodoManager`. We can also choose to create other implementations which store the data in a database or keeps the data in memory.



## Using services

In the procedures in our business logic we use agreements. At runtime we want to bind a service to be used for those agreement. We do this with bindings. With a binding we tell the application to use a particular service when it requests for an agreement. The following is an example of a procedure which asks for the `\todo\manager` agreement:

```php
when ( 'i want to add a todo', then ( apply ( a ( function ( todo $todo, todo\manager $manager )
{
	$manager->add ( $todo );
} ) ) ) );
```



Next we would create the following binding to tell the application to provide an instance of the `flatfileTodoManager` to use as the `\todo\manager` for the procedure:

```php
app::share ( todo\manager::class, function ( $app )
{
    $file = __DIR__ . '/../storage/db/files/todos.data';
    $todos = unserialize ( file_get_contents ( $file ) );

	if ( ! is_array ( $todos ) )
		$todos = [ ];
    
    return new flatfileTodoManager ( 
        $file,
        $todos
    );
} );
```

> As you can see we use the class-name `todo\manager::class` as the binding key. This is how the application knows it needs to resolve this binding when it sees the `\todo\manager` type-hint. The binding creates an instance of the `flatfileTodoManager` which is then used inside the procedure.