<?php

status::matching ( 1000, function ( array $habits )
{
    return response::ok ( 1000, array_values ( $habits ) );
} );