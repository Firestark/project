# Basic authentication

In this article we are going to use a PHP JWT package in combination with the session (for remembering the token) to create a basic authentication system.



## Prerequisites

- Working firestark application
- [Composer](https://getcomposer.org/)



## Abstraction

First of all we are going to create an abstraction class to encapsulate some methods and properties around the authentication process.

Create the file `/client/app/guard.php` with the following contents:

```php
<?php

namespace firestark;

use firestark\user\credentials;

abstract class guard
{
    /**
     * @var $public
     * All the publicly accessible routes.
     */
    private $public = 
        [ 'GET' => [ '/login', '/register', '/onboarding' ]
        , 'POST' => [ '/login', '/register' ]
        ];

    /**
     * Generate and store a token for given credentials.
     * @param credentials   The credentials to generate a token from.
     * @return string       The generated token.
     */
    abstract function stamp ( credentials $credentials ) : string;

    /**
     * Check if the given token is valid.
     */
    abstract function authenticate ( string $token ) : bool;

    abstract function getToken ( ) : string;

    /**
     * Remove token.
     */
    abstract function invalidate ( );

    /**
     * Check if the guard allows access to a given request.
     * @param string $request       The application feature request.
     * @param string $token         An optional token to access the $request with. 
     */
    function allows ( request $request, string $token = '' ) : bool
    {
        if ( in_array ( $request->uri, $this->public [ $request->method ] ) )
            return true;
        
        return $this->authenticate ( $token );
    }
}
```



## The JWT package

We are going to install a JWT package with composer. This JWT package generates and checks tokens by which we are going to authenticate a user.



Open a terminal in the root directory of the firestark project and run the following command:

```php
composer require firebase/php-jwt
```



## Implementation

Now that the JWT package is installed we need to use this package to create an implementation of the abstraction that we created earlier.



Create the file `/client/services/jwtSessionGuard.php` with the following contents:

```php
<?php

use Firebase\JWT\JWT;
use firestark\user\credentials;
use firestark\guard;
use firestark\session;

class jwtSessionGuard extends guard
{
    const key = 'my jwt key';
    private $session = null;

    function __construct ( session $session )
    {
        $this->session = $session;
    }

    function stamp ( credentials $credentials ) : string
    {
        $token = JWT::encode (
            [ 'credentials' => serialize ( $credentials )
            ]
        , self::key
        );

        $this->session->set ( 'token', $token );
        return $token;
    }

    function stamped ( ) : bool
    {
        return $this->session->has ( 'token' );
    }

    function authenticate ( string $token ) : bool
    {
        try {
            JWT::decode ( $token, self::key, array ( 'HS256' ) );
            return true;
        } catch ( exception $e ) {
            return false;
        }
    }

    function invalidate ( )
    {
        $this->session->unset ( 'token' );
    }

    function getToken ( ) : string
    {
        return $this->session->get ( 'token', '' );
    }

    function current ( ) : credentials
    {
        try {
            return unserialize ( JWT::decode ( 
                $this->session->get ( 'token' ), self::key, array ( 'HS256' ) )->credentials );
        }
        catch ( exception $e ) {
            return new credentials ( '', '' );
        }
    }
}
```



This implementation extends the class we created earlier.



## Bind to the application

Next we are going to bind the guard into the application. Create the file `/client/bindings/guard.php` and add the following contents:

```php
<?php

use firestark\guard;

app::share ( guard::class, function ( $app ) : guard
{
    return new jwtSessionGuard (
        $app [ 'session' ] 
    );
} );
```



## The guard facade

For easy access to the guard implementation we create a facade. Add the file `/client/facades/guard.php` and add the following contents:

```php
<?php

class guard extends facade
{
    public static function getFacadeAccessor ( )
    {
        return firestark\guard::class;
    }
}

```

## Setup the kernel

Next we need to setup the kernel so it runs the authentication. Open the `/client/app/kernel.php` file and change it's replace all it's content with the following:

```php
<?php

namespace firestark;

use http\dispatcher;
use http\request;


class kernel
{
    private $app = null;

    function __construct ( app $app )
    {
        $this->app = $app;
    }

    function handle ( request $request ) : \http\response
    {
        if ( ! $this->allows ( $request ) )
            return $this->deny ( );

        list ( $task, $arguments ) = $this->app [ 'dispatcher' ]->match ( 
            $request->method, $request->uri );
        
        // setting the arguments matched from the router onto the http request object
        // so they can be used throughout the app from the input facade
        foreach ( $arguments as $key => $value )
            \input::set ( $key, $value );
        
        return call_user_func_array ( $task, $arguments );
    }

    private function allows ( request $request ) : bool
    {
        $token = $this->app [ guard::class ]->getToken ( );
        return ( $this->app [ guard::class ]->allows ( $request, $token ) );
    }

    private function deny ( ) : \http\response
    {
        $this->app [ 'session' ]->set ( 'intended', $this->app [ 'request' ]->uri ( ) );
        return $this->app [ 'redirector' ]->to ( '/login' );
    }
}
```

We have added the check to see if the guard allows the current request. If not we redirect the user to the login page.



## Routes

The final thing that is left to do is implement the login and registration routes.



```php
<?php

route::get ( '/login', function ( )
{
   // return login page
} );
```



```php
<?php

route::get ( '/logout', function ( )
{
    guard::invalidate ( );
    
    session::flash ( 'message', 'Logged out.' );
    return redirect::to ( '/login' );
} );
```



```php
<?php

route::get ( '/register', function ( )
{
    return view::make ( 'login-register' );
} );
```



```php
<?php

use firestark\user;
use firestark\user\manager;

route::post ( '/login', function ( )
{
    $user = app::make ( user::class );
    
    if ( ! app::make ( manager::class )->has ( $user ) )
    {
        session::flash ( 'message', 'Invalid credentials' );
        return redirect::back ( );
    }

    guard::stamp ( $user->credentials );
    session::flash ( 'message', 'Logged in.' );
    return redirect::to ( session::get ( 'intended', '/' ) );
} );
```



```php
<?php

use firestark\user;
use firestark\user\credentials;
use firestark\user\manager;

route::post ( '/register', function ( )
{
    $user = app::make ( user::class );
    $userManager = app::make ( manager::class );

    if ( $userManager->registered ( $user->credentials->username ) )
    {
        session::flash ( 'message', 'Username already exists.' );
        return redirect::back ( );
    }

    $userManager->register ( $user );

    guard::stamp ( $user->credentials );
    return redirect::to ( '/' );
} );
```

