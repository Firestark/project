<?php

when('i want to update a todo', then(apply(a( 
    
function(Todo $todo, Todo\Manager $manager)
{
    if (! $manager->has($todo->id))
        return [2001, []];

    $manager->update($todo);
    return [1007, []];
}))));