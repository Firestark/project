<?php

class flatfileHabitManager implements habit\manager
{
    public $habits = [ ];

    function __construct ( array $habits )
    {
        $this->habits = $habits;
    }

    function has ( habit $habit ) : bool
    {
        return isset ( $this->habits [ $habit->title ] );
    }

    function add ( habit $habit )
    {
        $this->habits [ ] = $habit;
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
}