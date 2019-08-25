<?php

status::matching ( 2000, function ( habit $habit )
{
    return response::conflict ( 2000, 'Habit already exists' );
} );