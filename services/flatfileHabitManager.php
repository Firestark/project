<?php

class flatfileHabitManager implements habit\manager
{
    private $habits = [ ];
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
        $this->habits [ $habit->title ] = $habit;
        $this->write ( );
    }

    function all ( ) : array
    {
        return $this->habits;
    }

    function complete ( habit $habit )
    {
        $habit->completed = true;
        $this->write ( );
    }

    function remove ( habit $habit )
    {
        unset ( $this->habits [ $habit->title ] );
        $this->write ( );
    }

    private function write ( )
    {
        file_put_contents ( $this->file, serialize ( $this->habits ) );
    }

    public function __get ( string $property )
    {
        return $this->{ $property };
    }
}