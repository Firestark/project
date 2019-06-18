<?php

when ( 'i want to add a todo', then ( apply ( a ( 
    
function ( todo $todo, todo\manager $manager )
{
    if ( $manager->has ( $todo ) )
        return [ 2000, [ ] ];

    return [ 1000, [ ] ];
} ) ) ) );


// we could mock the todo and todo manager
// saying the has method gets todo and returns true
// then we can check wether status code 2000 has returned.

// Does this in any way help us?


class todo
{
    public $id = null;
    public $description = '';
    
    function __construct ( $id, string $description )
    {
        $this->id = $id;
        $this->description = substr ( $description, 0, 30 );
    }
}

// We can check wether $description is max 30 chars long

// Does this help us in any way?