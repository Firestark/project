<?php

class habit
{
    public $title, $completed;

    function __construct ( string $title, bool $completed = false )
    {
        $this->title = $title;
        $this->completed = $completed;
    }
}