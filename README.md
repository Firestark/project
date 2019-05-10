<img src="./logo.svg" width="250" align="center" vertical-align="top">
<br>


Firestark is a **non mvc PHP7 framework** which separates business logic from implementation logic. Firestark achieves this separation by giving you a special architecture that completely rids the business logic from outside dependencies. Instead the implementation logic is responsible for dependencies and speaks with the businnes logic to make a working application. This way the business logic is a very simple and readable layer to work in.


An example project can be found [here](https://github.com/firestark/goalstark)

<br>
<br>
<br>

```php
<?php

use function compact as with;

when ( 'i want to add a todo', then ( apply ( a ( 
    
function ( todo $todo, todoManager $todoManager )
{
    if ( $todoManager->has ( $todo ) )
        return [ 2000, with ( 'todo' ) ];

    $todoManager->add ( $todo );
    return [ 1000, with ( 'todo' ) ];
} ) ) ) );
```
> Firestark's business logic code example

<br>
<br>

## Firestark's propositions

### Business driven architecture

Firestark puts business logic first. At the highest level you will immediately see what the application is meant to do. Technical implementations can be found at lower levels.

### You ain't gonna need it

Firestark is built with [YAGNI](https://martinfowler.com/bliki/Yagni.html) in mind. Adding more code adds more complexity, often in vain. Firestark provides just the functionality you need and not a line of code more.

### Flexibility

Firestark is very small by default and uses the following components:

- IOC container
- small HTTP layer
- Http router

With these components firestark provides you a basic architecture to built well structured, business driven applications. The architecture is built in such a way that you can easily extend it with your own favourite components.

### Fast

Because firestark does not include any unnecessary code building fast and robust applications with firestark is easy.

<br>
<br>

## Getting started

### Server Requirements

- PHP >= 7.1.3

### Setup

1. In client/config.php correct the BASE URL.
2. Make sure the app can write inside the client/storage directory.
3. Run composer install inside the root directory.

<br>
<br>

## Directory structure

| Directory         | Description                   |
| -------------     |-------------------------------|
| /app              | Business logic                |
| /app/procedures   | Business logic procedures     |
| /app/agreements   | Business logic entities       |
| /client           | Technical layer               |
| /client/services  | Implementation of agreements  |
| /client/bindings  | App implementations bindings  |
| /client/routes    | Http routes                   |
| /client/statuses  | Business status matchers      |



## Inspirations

> A good architecture allows for major decisions to be defered
Robert C. Martin