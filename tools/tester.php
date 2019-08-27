<?php

namespace firestark;

use closure;

class tester
{
    public $tests = [ ];
    private $app = null;

    function __construct ( app $app )
    {
        $this->app = $app;
    } 
    
    function add ( string $feature, string $description, closure $test )
    {
        $this->tests [ ] = new testcase ( $feature, $description, $test );
    }

    function run ( )
    {
        foreach ( $this->tests as $test )
            $this->convert ( $test );
    }

    function convert ( testcase $testcase )
    {
        $app = $this->app;

        describe ( $testcase->feature, function ( ) use ( $app, $testcase )
        {
            beforeEach ( function ( ) use ( $app )
            {
                $this->app = $app;
            } );

            it ( $testcase->description, function ( ) use ( $testcase )
            {
                try {
                    $this->app->call ( $testcase->test );
                } catch ( \exception $e ) {
                    // shorten long stack trace on failure
                    throw new \exception ( $e->getMessage ( ) );
                }
            } );
        } );
    }
}