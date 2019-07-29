<?php

when('i want to add a todo', then(apply(a( 
    
function(Todo $todo, Todo\Manager $manager)
{
    if ($manager->hasTodoWithDescription($todo->description))
        return [ 2000, []];

    $manager->add($todo);
    return [1000, []];
}))));