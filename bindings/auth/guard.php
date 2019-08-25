<?php

app::share ( guard::class, function ( )
{
    return new jwtGuard;
} );