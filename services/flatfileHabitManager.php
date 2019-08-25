<?php

class flatfileHabitManager implements habit\manager
{
    private $directory = '';

    public function __construct ( string $directory )
    {
        $this->directory = $directory;
    }

    function allFor ( user $user ) : array
    {
        return [];
    }
}