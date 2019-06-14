<img src="../logo.svg" width="250" vertical-align="top">



Firestark is a **non mvc PHP7 framework** which separates business logic from implementation logic. Firestark achieves this separation by giving you a special architecture that completely rids the business logic from outside dependencies. Instead the implementation logic is responsible for dependencies and speaks with the businnes logic to make a working application. This way the business logic is a very simple and readable layer to work in.



```php
<?php
    
when ( 'i want to add a todo', then ( apply ( a ( 
    
function ( todo $todo, todo\manager $manager )
{
    if ( $manager->has ( $todo->description ) )
        return [ 2000, [ ] ];

    $manager->add ( $todo );
    return [ 1000, [ ] ];
} ) ) ) );
```



> Example 1. A business procedure example



# The architecture

Your application is split up into two layers. One layer is the business logic layer. This layer is responsible for enforcing business rules and returning a status code. The other layer is the implementation layer. This layer is responsible for implementing the business logic layer to create a working application.



## The business logic

The business logic layer is split up in *agreements*  and *procedures*.