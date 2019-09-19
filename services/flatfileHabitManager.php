<?php

class flatfileHabitManager implements habit\manager
{
    public $habits = [ ];
    private $file = '';

    function __construct ( array $habits, string $file )
    {
        $this->habits = $habits;
        $this->file = $file;
    }

    function has ( habit $habit ) : bool
    {
        return isset ( $this->habits [ $habit->title ] );
    }

    function add ( habit $habit )
    {
        $this->habits [ ] = $habit;
        $this->write ( );
    }

    function all ( ) : array
    {
        return $this->habits;
    }

    function complete ( habit $habit )
    {
        $habit->completed = true;
    }

    function remove ( habit $habit )
    {
        unset ( $this->habits [ $habit->title ] );
    }

    private function write ( )
    {
        file_put_contents ( $this->file, serialize ( $this->habits ) );
    }
}