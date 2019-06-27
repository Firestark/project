# Todo application

In this tutorial we are going to create a small todo application using firestark. This tutorial is supposed to be a beginner introduction to using firestark and will give you a clear idea of the architecture that firestark uses.

## The application

The todo application is going to keep a list of to-dos. These to-dos will have an ID, a description and a completion status. Within this application we will enforce **1 business rule** which is: `A todo description may only occur once`.



## Setup

### Prerequisites

- [Composer](https://getcomposer.org/download/)
- PHP7+

### Install firestark

First run the following command in the directory you want to create your todo application:

`composer create-project --prefer-dist firestark/project todo`



For the purposes of this example we are running this todo application using the PHP built-in web server. If you have your own development server you can use that instead. Remember though when using your own development server that firestark does not handle sub directories by default and therefor you may need to setup a v-host.



```php
php -S localhost:8000
```

> Command to run PHP built-in server



## The business logic

It's most logical to start with a procedure in the business logic. Let's start by creating the procedure to add a new todo.



Create the file `/app/procedures/i want to add a todo.php` and add the following code:

```php
<?php

when ( 'i want to add a todo', then ( apply ( a ( 
    
function ( todo $todo, todo\manager $manager )
{
    if ( $manager->hasTodoWithDescription ( $todo->description ) )
        return [ 2000, [ ] ];

    $manager->add ( $todo );
    return [ 1000, [ ] ];
} ) ) ) );
```



#### A word about filenames

Let's talk about the filename. The filename is: `i want to add a todo.php`. As you can see this is a filename that describes what we are going to do inside the file. You can name this file anyway you like and place it in nested directories if you wish as long as the file end in the `.php` extension. This is a very important part for the business logic of our application. When we name our procedures with descriptive names that make sense for the business logic of our application, then when we look into the procedures directory we can immediately see what the application can do.



#### Business rules

In the procedure above you can see a business rule that is enforced namely:  `A todo description may only occur once`. This is enforced with the: 

```php
$manager->hasTodoWithDescription ( $todo->description )
```

In this case we don't add the todo but return the status `2000`. Only if it passes this business rule will we add the todo to the manager and return the status `1000`.



#### Follow-up

Now that we have created this procedure we can see a few things we need to create next. First of all this procedure takes 2 parameters of type: `\todo` and `\todo\manager`. These 2 parameters are agreements we need to create. Inside the procedure we can already see that these agreements need some properties and methods. For the `\todo`  we need the property description. For the `\todo\manager` we need the methods `hasTodoWithDescription ( $description )` and `add ( \todo $todo )`. 

Next to the agreements we need to create we can also see that we need to create the status codes `2000 and 1000` which you can tell by the numbers in the returned array . We can guess from here that status `2000` is the status for when a todo with given description already exists. The status `1000`  would be the status for when a todo has successfully been added.



### Agreements

Let's create the `\todo` agreement. Create the file `\app\agreements\todo.php` and add the following code:

```php
<?php

class todo
{
    public $id = null;
    public $description = '';
    public $completed = false;

    function __construct ( $id, string $description, bool $completed = false )
    {
        $this->id = $id;
        $this->description = $description;
        $this->completed = $completed;
    }
}
```



Next we will create the `\todo\manager` agreement. Create the directory `/app/agreements/todo` and the Create the file `/app/agreements/todo/manager.php` and add the following code:

```php
<?php

namespace todo;

use todo;

interface manager
{   
    function hasTodoWithDescription ( string $description ) : bool;
    
    function add ( todo $todo );
}
```

This `\todo\manager` is an interface. This is because the todo manager is going to keep a collection of to-dos and to persist these to-dos it needs to communicate with a persistence mechanism which is a technical detail the business logic may know nothing about. With this interface the business logic tells the technical layer what it expect out of a todo manager. In contrast with the todo agreement we create above, there we simply used a class. This is because the todo agreement simply describes what a todo looks like with pure PHP. Therefor we can just use a class in that case.



## The implementation logic

In the previous section we have implemented our business logic by created a procedure and 2 agreements. Now it is time to create the implementation logic so we can create an actual working application. In this section we are going to create:

- Services
- Bindings
- Statuses
- HTTP Routes
- Views



### Services

In the business logic we created the `\todo\manager` agreement which is an interface. That interface describes what methods we need to implement. In this case we need to implement the following methods:

```php
function hasTodoWithDescription ( string $description ) : bool;

function add ( todo $todo );
```



We are now going to create a class that implements that `\todo\manager` interface. Create the file `/client/services/flatfileTodoManager.php` and add the following code:

```php
<?php

class flatfileTodoManager implements todo\manager
{
    private $todos = [ ];
    private $file = '';

    function __construct ( string $file, array $todos )
    {
        $this->file = $file;
        $this->todos = $todos;
    }

    function add ( todo $todo )
    {
        $this->todos [ $todo->id ] = $todo;
        $this->write ( );
    }

    function hasTodoWithDescription ( string $description ) : bool
    {
        foreach ( $this->todos as $todo )
            if ( $todo->description === $description )
                return true;
        
        return false;
    }

    private function write ( )
	{
		file_put_contents ( $this->file, serialize ( $this->todos ) );
    }
}
```

This class is going to store a collection of todos as a serialized array inside a file. 



### Bindings

With binding we tell the application how to create agreements or how to use a particular service for an agreement. In our case we need to bind the `\todo` and `\todo\manager` agreement.

First we will create the bindings for the `\todo` agreement. Create the file `/client/bindings/todo.php` and add the following code:

```php
<?php

app::bind ( todo::class, function ( $app )
{
    return new todo (
        input::get ( 'id', uniqid ( ) ),
        input::get ( 'description', '' )
    );
} );
```

This binding tell the application that whenever we ask for a `\todo` we want to run the previous function. That function uses the input facade which checks the incoming request for data under the name of `id` and `description`. If those 2 pieces of data are provided it uses that to instantiate a new todo class. If those 2 pieces of data are not available it uses a default of`uniqid()` and `'' `(empty string)  to create the todo. 



Next we need a binding for the `\todo\manager`agreement. Whenever we ask for a `\todo\manager` we want to receive an instance of the `flatfileTodoManager` service. Let's create that binding now. Create the file `/client/bindings/todo-manager.php` and add the following code:

```php
<?php

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

This binding expects the file `/client/storage/db/files/todos.data`. Create these directories and the file now.





... Work in progress