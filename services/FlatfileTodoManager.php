<?php

class FlatfileTodoManager implements Todo\Manager
{
    private $todos = [];
    private $file = '';

    function __construct(string $file, array $todos)
    {
        $this->file = $file;
        $this->todos = $todos;
    }

    function all(): array
    {
        return $this->todos;
    }

    function find($id): Todo
    {
        return $this->todos[$id];
    }

    function add(Todo $todo)
    {
        $this->todos[$todo->id] = $todo;
        $this->write();
    }
    
    function has($id): bool
    {
        return isset($this->todos[$id]);
    }

    function hasTodoWithDescription(string $description): bool
    {
        foreach ($this->todos as $todo)
            if ($todo->description === $description)
                return true;
        
        return false;
    }

    function update(Todo $todo)
    {
        $this->todos[$todo->id] = $todo;
        $this->write();
    }

    function remove($id)
    {
        unset($this->todos[$id]);
        $this->write();
    }

    private function write()
	{
		file_put_contents($this->file, serialize($this->todos));
    }
}
