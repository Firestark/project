# Procedures

A procedure is part of the business logic and applies rules decided by the business to the application. The following are examples of such rules:
- A todo with given description may only be saved once.
- A person with a bronze account has 10% price reduction on his total buyings.
- Booking a flight in holiday seasons adds an additional 15% cost on the base price.

Next to applying these rules the procedure usually calls some methods to create, read, update or delete some entities in the application. 
A procedure always returns a status with optionally some data relevant to that status. This status indicates a meaning of the results from the applied business rules. 


```php

when ( 'i want to add a todo', then ( apply ( a ( 
    
function ( todo $todo, todo\manager $manager )
{
    $manager->add ( $todo );
    return [ 1000, [ ] ];
} ) ) ) );


```

Above is an example of a simple procedure for adding a todo. This code registers the ``'i want to add a todo'`` string to the given closure inside the application. 
This closure uses an instance of the ``todo`` and ``todo\manager`` to add a todo and return the status code 1000. The technical layer is responsible to provide this procedure with a ``todo`` and ``todo\manager`` instance. The status code (1000 in this case) and it's meaning is made up by ourselves. In the case of the example above it means we successfully added a todo.


## A more sophisticated example

The previous example doesn't apply any constraint to adding todo's. The business might say we don't want to allow adding todo's with the same description. A procedure to apply this rule can look like the following:


```php

when ( 'i want to add a todo', then ( apply ( a ( 
    
function ( todo $todo, todo\manager $manager )
{
    if ( $manager->hasTodoWithDescription ( $todo->description ) )
        return [ 2000, [ ] ];

    $manager->add ( $todo );
    return [ 1000, [ ] ];
} ) ) ) );


```

If the ``todo\manager`` instance  has a todo with given description we return a status of 2000 and never add the todo to the manager. This status code of 2000 indicates a failure of adding the todo because a todo with given description already exists.



<br>
<br>


Procedures are located inside the /app/procedures directory. Any .php file inside this directory and nested directories is automatically included inside your project.



## Running a procedure

Procedures are stored under a name inside the application. To run a procedure we call the fulfill method with the given name on the application instance.


```php

app::fulfill ( 'i want to add a todo' );

```

The code above is an example of the running the procedure we have defined above. the dependencies of that procedure are automatically resolved by the application. The status returned by the procedure gets matched by the application and the bound status matcher will run.