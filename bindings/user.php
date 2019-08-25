<?php

app::bind ( user::class, function ( $app )
{
    return new user ( $app [ user\credentials::class ] );
} );