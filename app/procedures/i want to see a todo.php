<?php

use function compact as with;

when('i want to see a todo', then(apply(a( 
    
function($id, Todo\Manager $manager)
{
    if (! $manager->has($id))
        return [2001, []];

    $todo = $manager->find($id);
    return [1002, with('todo')];
}))));