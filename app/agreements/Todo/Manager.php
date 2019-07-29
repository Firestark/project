<?php

namespace Todo;

use Todo;

interface Manager
{   
    function hasTodoWithDescription(string $description): bool;
    
    function add(todo $todo);

    function all(): array;

    function has($id): bool;

    function update(todo $todo);

    function remove($id);

    function find($id): todo;
}