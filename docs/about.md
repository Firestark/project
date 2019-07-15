<img src="../logo.svg" width="250" vertical-align="top">



Firestark is a **non MVC PHP7 framework** which separates business logic from implementation logic. Firestark achieves this separation by giving you an application architecture that completely rids the business logic from outside dependencies. In firestark's application architecture the implementation logic is responsible for dependencies and speaks with the businesses logic to make a working application. This way the business logic is a very simple and readable layer to work in.



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

Your application is split up into two layers. One layer is the business logic layer. This layer is responsible for enforcing business rules. The other layer is the implementation layer. This layer is responsible for implementing the requirements of the business logic layer and using technical components to create a working application.

## The business logic

The business logic layer is split up in *agreements* and *procedures*. Agreements consist of **self contained** classes, abstract classes and interfaces. These agreements may contain some *non application specific business rules* that have to be enforced for all your applications. An example of that could be: A person has to be above the age of 18 to be allowed to buy products in our store. If this rule needs to be enforced for the entire business and not just this application it is a good idea to put that rule in an agreement. 

procedures are small functions that use agreements to enforce *application specific business rules*. A procedure always returns a status code. That status code is an integer and is up to the developer to decide what integer to return based on the results of the applied business rules. **Example 1  ** (located at the start of this document) is an example of a procedure.

The most important thing to understand of the business logic layer is that this layer may know nothing about implementation details. This means that this layer knows nothing about what database is used or how it is delivered to the client (HTML, JSON).  

## The implementation logic

The implementation logic is split up into multiple sections. A section for each input output channel (IO channel) you choose to implement and a global section for components you use for every IO channel. Each IO channel consist of the components: Routes, bindings and status matchers. The global section consists of: Bindings, facades, services and tools.

### IO channels

IO channels are mediums to provide input to the application and receive output from the application. By default firestark provides you the IO channels for 'the web' and a JSON API. The web is the IO channel which uses HTML to provide input to the application via HTML forms and receiving output via HTML 'views'. The JSON API expects input as a JSON object and sends back a response as a JSON object. Firestark is built in such a way that you can choose to use either one of those or both or even neither and setup another IO channel to use instead.



### Global components

#### Bindings

Bindings are a map of key, value pairs we register inside the application. The key can be any string you like. The value is a closure that returns any value you want. Whenever you resolve the key from the application you will get the value that the closure returns. 

One of the major use cases of bindings is resolving the procedure parameters inside the business logic. Whenever the application encounters a type hinted class inside the procedure's parameters it will look into it's bindings for a key of that type hinted full class-name. This is the way we provide the procedures the parameters it needs.

Bindings inside the global components section are bindings we use for every IO channel.

### Facades

Facades give static access to technical components and are used inside the implementation layer only. With a facade we don't need an instance of a component but instead use the facade with a static call directly. Facades are really useful in situations where we want access to technical components but don't really want to inject them as function arguments.

#### Services

Agreements inside the business logic may know nothing about technical details. One example of this is that the agreements can not directly talk to a database. To still be able to store changes in a database we create a service inside the implementation layer that extends or implements the agreement. This service can talk to a database to store changes.

#### Tools

Tools contain some technical components that are needed to create a working application. The components are placed inside the tools directory so you can easily customize some of the important behaviour of the framework.



### IO components

#### Bindings

Bindings inside the IO components sections are exactly the same as the bindings we described above in the global components section with the exception that IO component bindings are specifically for the IO channel in which they are placed inside. With these IO component bindings we can choose to use different components per IO channel.

#### Routes

Routes are a map of key, value pairs. The key is an HTTP URI. The value is a closure which either calls a business procedure and returns that result or returns an HTTP response.

#### Status matchers

The business logic communicates an arbitrary meaning to the implementation layer with status codes. It's the responsibility of the status matcher to match that status code and turn that arbitrary meaning into a HTTP response.





## Directory structure

| Directory       | Description                            |
| --------------- | -------------------------------------- |
| /app            | Business logic                         |
| /app/procedures | Business logic procedures              |
| /app/agreements | Business logic entities                |
| /bindings       | IO channel shared bindings             |
| /facades        | Easy accessors to technical components |
| /io             | IO channels                            |
| /io/*/bindings  | IO specific bindings                   |
| /io/*/routes    | IO specific HTTP routes                |
| /io/*/statuses  | IO specific status matchers            |
| /services       | Agreement implementations              |
| /storage        | Place to store cache, tmp, files, etc  |
| /tools          | Core technical  components             |


## Getting started

### Server requirements

- PHP >= 7.1.3
- Host pointing to / (for example: virtual host) (Sub directories are not handled by default)

### Installation

1. `composer create-project firestark/project`
2. Make sure the application can write inside the client/storage directory