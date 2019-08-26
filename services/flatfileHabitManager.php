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
        $file = $this->directory . md5 ( $user->credentials->username ) . '/habits.data';
        $data = unserialize ( file_get_contents ( $file ) );

        return ( is_array ( $data ) ) ? $data : [ ];

    }

    function add ( habit $habit, user $user )
    {
        $habits = $this->allFor ( $user );
        $habits [ $habit->id ] = $habit;

        $this->write ( $habits, $user );
    }

    function hasTitle ( string $title, user $user ) : bool
    {
        $habits = $this->allFor ( $user );
        
        foreach ( $habits as $habit )
            if ( $habit->title === $title )
                return true;
        
        return false;
    }

    private function write ( array $habits, user $user )
    {
        $file = $this->directory . md5 ( $user->credentials->username ) . '/habits.data';
        file_put_contents ( $file, serialize ( $habits ) );
    }
}