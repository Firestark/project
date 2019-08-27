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
        $this->tests [ $feature ] [ ] = new testcase ( $feature, $description, $test );
    }

    function run ( )
    {
        foreach ( $this->tests as $feature => $testcases )
            $this->convert ( $feature, $testcases );
    }

    private function convert ( string $feature, array $testcases )
    {
        $app = $this->app;

        describe ( $feature, function ( ) use ( $app, $testcases )
        {
            beforeEach ( function ( ) use ( $app )
            {
                $this->app = $app;
            } );

            foreach ( $testcases as $testcase )
            {
                it ( $testcase->description, function ( ) use ( $testcase )
                {
                    try {
                        $this->app->call ( $testcase->test );
                    } catch ( \exception $e ) {
                        // shorten long stack trace on failure
                        throw new \exception ( $e->getMessage ( ) );
                    }
                } );
            }
        } );
    }
}