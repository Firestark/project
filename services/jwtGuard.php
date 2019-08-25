<?php

use Firebase\JWT\JWT;
use user\credentials;

class jwtGuard implements guard
{
    const key = 'eye-fire';

    function stamp ( credentials $credentials ) : string
    {
        $token = JWT::encode (
            [ 'credentials' => serialize ( $credentials )
            ]
        , self::key
        );

        return $token;
    }

    function read ( string $token ) : credentials
    {
        try {
            return unserialize ( JWT::decode ( $token, self::key, array ( 'HS256' ) )->credentials );
        }
        catch ( exception $e ) {
            return new credentials ( '', '' );
        }
    }
}