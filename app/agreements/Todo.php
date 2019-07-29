<?php

class Todo
{
    public $id = null;
    public $description = '';
    public $completed = false;

    public function __construct($id, string $description, bool $completed = false)
    {
        $this->id = $id;
        $this->description = $description;
        $this->completed = $completed;
    }
}

