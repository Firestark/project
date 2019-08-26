<?php

status::matching ( 1001, function ( habit $habit )
{
    return response::created ( 1001, $habit );
} );