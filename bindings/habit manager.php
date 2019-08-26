<?php

app::share ( habit\manager::class, function ( )
{
    return new flatfileHabitManager ( __DIR__ . '/../storage/databases/files/' );
} );