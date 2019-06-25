# Todo

In this tutorial we are going to create a small todo application using firestark. Among others this tutorial will show you how to enforce business rules, how to extend firestark with the laravel blade template engine and how to do routing.

## The application

The todo application is going to keep a list of to-do's. These to-do's will have an ID, a description and a completion status. Within this application we will enforce **1 business rule** which is: ``A todo description may only occur once`.



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

Firestark put's the business logic first. It's most logical to start with a procedure in this business logic. Let's start by creating the procedure to add a new todo.



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

First of all let's talk about the filename. The filename is: `i want to add a todo.php`. As you can see this is a filename that describes what we are going to do inside the file. You can name this file anyway you like and place it in nested directories if you wish as long as the file end in the `.php` extension. This is a very important part for the business logic of our application. When we name our procedures with descriptive names that make sense for the business logic of our application, then when we look into the procedures directory we can immediatly see what the application can do.