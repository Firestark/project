<?php

when('i want to remove a todo', then(apply(a( 
    
function ($id, Todo\Manager $manager)
{
    $manager->remove($id);
    return [1003, []];
}))));