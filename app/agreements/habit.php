<?php

class habit
{
    public $id;
    public $title;
    public $completions;

    public function __construct ( $id, string $title, array $completions = [ ] )
    {
        $this->id = $id;
        $this->title = $title;
        $this->completions = $completions;
    }

    public function add ( int $timestamp )
    {
        $value = beginOfDay ( $timestamp );
        if ( ! in_array ( $value, $this->completions ) )
            $this->completions [ ] = $value;
        rsort ( $this->completions );
    }

    public function remove ( int $timestamp )
    {
        $value = beginOfDay ( $timestamp );
        
        foreach ( $this->completions as $key => $completion )
            if ( $value === $completion )
                unset ( $this->completions [ $key ] );
            
        rsort ( $this->completions );
    }

    public function streak ( ) : int
    {
        if ( empty ( $this->completions ) )
            return 0;

        $streak = 1;
        
        foreach ( $this->completions as $key => $completion ) {
            if ( isset ( $this->completions [ $key + 1 ] ) 
                && $this->chain ( $completion, $this->completions [ $key + 1 ] ) )
                    $streak++;
            else
                break;
        }

        return $streak;
    }

    private function chain ( int $current, int $previous ) : bool
    {
        $difference = $current - $previous;
        return ( ( int ) round ( $difference / ( 60 * 60 * 24 ) ) ) === 1;
    }
}